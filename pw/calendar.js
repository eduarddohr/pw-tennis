var calendar = new Calendar(
  "calendarContainer", // id of html container for calendar
  "small", // size of calendar, can be small | medium | large
  [
    "Monday", // left most day of calendar labels
    3 // maximum length of the calendar labels
  ],
  [
    "#616161", // primary color
    "#000", // primary dark color
    "#fff", // text color
    "#fff" // text dark color
  ]
);

// initializing a new organizer object, that will use an html container to create itself
var organizer = new Organizer(
  "organizerContainer", // id of html container for calendar
  calendar, // defining the calendar that the organizer is related to
  datal // giving the organizer the static data that should be displayed
);