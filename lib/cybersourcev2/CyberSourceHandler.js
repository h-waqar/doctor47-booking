/**
 * CyberSourceHandler - OPTIMIZED VERSION
 * Only generates token when needed, no automatic tokenization
 */
class SdvCyberSourceHandlerV2 {
  constructor(options = {}) {
    this.flex = null;
    this.microform = null;
    this.isInitialized = false;

    // config
    this.restUrl = options.restUrl;
    this.ajaxUrl = options.ajaxUrl;
    this.cardContainer = options.cardContainer || "#cybs-card-number-container";
    this.cvvContainer = options.cvvContainer || "#cybs-security-code-container";

    // token management
    this.token = null;
    this.tokenExpiresAt = 0;
    this.tokenExpiryTimeoutId = null;
    this.tokenRequestInFlight = false;

    // Track field validity
    this.cardNumberValid = false;
    this.cvvValid = false;

    // timings
    this.tokenTTL = options.tokenTTL || 10 * 60 * 1000; // 10 minutes
  }

  async initCyberSource() {
    try {
      console.log("Initializing CyberSource Microform...");
      const captureContext = await this.fetchCaptureContext();
      console.log("Capture Context fetched.");

      await this.loadMicroformScript(captureContext);
      console.log("Microform script loaded.");

      if (typeof window.Flex === "undefined") {
        throw new Error("Flex library did not load.");
      }

      this.setupMicroform(captureContext);
      this.isInitialized = true;
      console.log("CyberSource Microform initialized successfully.");

    } catch (e) {
      console.error("CyberSource Initialization Failed:", e);
    }
  }

  async fetchCaptureContext() {
    const res = await fetch(this.restUrl, { method: "POST" });
    if (!res.ok) {
      const errorData = await res.text();
      throw new Error("Could not create secure payment session: " + errorData);
    }
    const json = await res.json();
    if (!json.captureContext) {
      throw new Error("Capture context not found in server response.");
    }

    return json.captureContext;
  }

  loadMicroformScript(captureContext) {
    const payload = this.parseJwtPayload(captureContext);
    const clientLibrary = payload?.ctx?.[0]?.data?.clientLibrary;
    if (!clientLibrary) {
      throw new Error(
        "Could not find Microform library URL in capture context."
      );
    }

    return new Promise((resolve, reject) => {
      const script = document.createElement("script");
      script.src = clientLibrary;
      script.onload = () => resolve();
      script.onerror = () =>
        reject(new Error("Failed to load the CyberSource Microform library."));
      document.head.appendChild(script);
    });
  }

  setupMicroform(captureContext) {
    const styles = {
      input: {
        "font-size": "16px",
        "line-height": "1.5",
        height: "38px",
        padding: "6px 12px",
      },
      "::-webkit-input-placeholder": { color: "#888" },
      "::placeholder": { color: "#888" },
    };

    this.flex = new window.Flex(captureContext);
    this.microform = this.flex.microform({
      styles: styles,
      placeholder: {
        number: "•••• •••• •••• ••••",
        securityCode: "CVV",
      },
      showErrorMessages: false,
    });

    // create fields
    const number = this.microform.createField("number");
    const securityCode = this.microform.createField("securityCode");

    // mount fields
    number.load(this.cardContainer);
    securityCode.load(this.cvvContainer);

    // Track field validity ONLY - NO automatic tokenization
    number.on("change", (data) => {
      this.cardNumberValid = data.valid;
      console.log("Card number valid:", data.valid);
    });

    securityCode.on("change", (data) => {
      this.cvvValid = data.valid;
      console.log("CVV valid:", data.valid);
    });

    // Generate token on blur (when user finishes typing)
    let tokenGenerationTimeout;
    const attemptTokenGeneration = () => {
      clearTimeout(tokenGenerationTimeout);
      tokenGenerationTimeout = setTimeout(() => {
        if (this.cardNumberValid && this.cvvValid && !this.isTokenFresh()) {
          console.log("Auto-generating token on blur...");
          this.generateTokenSilently();
        }
      }, 500);
    };

    number.on("blur", attemptTokenGeneration);
    securityCode.on("blur", attemptTokenGeneration);
  }

  async getToken() {
    return new Promise((resolve, reject) => {
      if (!this.microform) {
        reject(new Error("CyberSource Microform is not initialized."));
        return;
      }

      const expirationMonth =
        document.querySelector("#cybs-expiration-month")?.value || "12";
      const expirationYear =
        document.querySelector("#cybs-expiration-year")?.value || "2034";

      console.log(
        "Creating token with expiration:",
        expirationMonth + "/" + expirationYear
      );

      const options = {
        expirationMonth: expirationMonth,
        expirationYear: expirationYear,
      };

      this.microform.createToken(options, (err, token) => {
        if (err) {
          const errorMessage =
            err.details?.map((d) => d.message).join(" ") ||
            err.message ||
            "Please check your card details and try again.";
          reject(new Error(errorMessage));
        } else {
          const transientToken =
            token?.transientToken ||
            token?.flexToken ||
            token?.token ||
            token?.flexResponse?.transientToken ||
            token;

          if (!transientToken) {
            reject(new Error("No token received from CyberSource."));
          } else {
            resolve(transientToken);
          }
        }
      });
    });
  }

  isTokenFresh() {
    return !!this.token && Date.now() < this.tokenExpiresAt;
  }

  invalidateToken() {
    this.token = null;
    this.tokenExpiresAt = 0;
    if (this.tokenExpiryTimeoutId) {
      clearTimeout(this.tokenExpiryTimeoutId);
      this.tokenExpiryTimeoutId = null;
    }
    const hiddenInput = document.getElementById("cybs_token");
    if (hiddenInput) hiddenInput.value = "";
  }

  /**
   * Generate token silently in background (called on blur)
   */
  async generateTokenSilently() {
    if (this.tokenRequestInFlight) {
      console.log("Token generation already in progress");
      return;
    }

    this.tokenRequestInFlight = true;

    try {
      console.log("Generating token silently...");
      const transient = await this.getToken();

      this.token = transient;
      this.tokenExpiresAt = Date.now() + this.tokenTTL;

      const hiddenInput = document.getElementById("cybs_token");
      if (hiddenInput) {
        hiddenInput.value = this.token;
        console.log("Token generated and stored successfully");
      }

      if (this.tokenExpiryTimeoutId) {
        clearTimeout(this.tokenExpiryTimeoutId);
      }
      this.tokenExpiryTimeoutId = setTimeout(() => {
        if (Date.now() >= this.tokenExpiresAt) {
          this.invalidateToken();
        }
      }, this.tokenTTL + 100);
    } catch (error) {
      console.error("Silent token generation failed:", error);
      this.invalidateToken();
    } finally {
      this.tokenRequestInFlight = false;
    }
  }

  /**
   * Ensure token is available (called before payment submission)
   */
  async ensureToken() {
    if (this.isTokenFresh()) {
      console.log("Token is fresh, using existing token");
      return this.token;
    }

    if (this.tokenRequestInFlight) {
      console.log("Token generation in progress, waiting...");
      await new Promise((resolve) => setTimeout(resolve, 1000));
      if (this.isTokenFresh()) {
        return this.token;
      }
    }

    console.log("Generating fresh token...");
    this.tokenRequestInFlight = true;

    try {
      const transient = await this.getToken();

      this.token = transient;
      this.tokenExpiresAt = Date.now() + this.tokenTTL;

      const hiddenInput = document.getElementById("cybs_token");
      if (hiddenInput) {
        hiddenInput.value = this.token;
        console.log("Fresh token generated and stored");
      }

      if (this.tokenExpiryTimeoutId) {
        clearTimeout(this.tokenExpiryTimeoutId);
      }
      this.tokenExpiryTimeoutId = setTimeout(() => {
        if (Date.now() >= this.tokenExpiresAt) {
          this.invalidateToken();
        }
      }, this.tokenTTL + 100);

      return this.token;
    } catch (error) {
      console.error("Token generation failed:", error);
      throw error;
    } finally {
      this.tokenRequestInFlight = false;
    }
  }

  parseJwtPayload(jwt) {
    try {
      return JSON.parse(
        atob(jwt.split(".")[1].replace(/-/g, "+").replace(/_/g, "/"))
      );
    } catch {
      return null;
    }
  }
}
