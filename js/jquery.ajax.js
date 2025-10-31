function getData(element) {
  // because currently tests are static
  // ****** So listen test function will be used on date refresh not ajax
  // *******
  // var inputPCRAntigen = document.getElementById("inputPCRAntigen");
  // ListenTest(inputPCRAntigen);
  // console.log("get data function is called");
  // updateTestCenter(element);
  // var islandId = element.value;
  // islandId = islandId.split(",");
  // islandId = islandId[1];
  // var selectedCurrency = document.getElementById("selectedCurrency").value;
  // $.ajax({
  //   url: ajax_object.ajaxurl, // this is the object instantiated in wp_localize_script function
  //   type: "POST",
  //   data: {
  //     action: "myaction", // this is the function in your functions.php that will be triggered
  //     selectedCurrency: selectedCurrency,
  //     islandId: islandId,
  //   },
  //   success: function (data) {
  //     //Do something with the result from server
  //     // $("#selectedTest").append(data);
  //     // $("#selectedTest").find("option").remove().end().append(data);
  //     // var selectedTest = document.getElementById("selectedTest");
  //     // updatePayment(selectedTest);
  //   },
  // });
}

function get_time_slots(selectedDate) {
  var selectedDate = selectedDate;

  $.ajax({
    url: ajax_object.ajaxurl, // this is the object instantiated in wp_localize_script function
    type: "POST",
    data: {
      action: "myaction", // this is the function in your functions.php that will be triggered
      selectedDate: selectedDate,
    },
    success: function (data) {
      //Do something with the result from server

      var wrapTimeSlots = document.getElementById("wrapTimeSlots");
      var timeSlotDate = document.getElementById("timeSlotDate");

      timeSlotDate.innerHTML = selectedDate;
      wrapTimeSlots.innerHTML = data;

      set_on_click_on_time_slots();
      // $("#selectedTest").append(data);
      // $("#selectedTest").find("option").remove().end().append(data);
      // var selectedTest = document.getElementById("selectedTest");
      // updatePayment(selectedTest);
    },
  });
}
