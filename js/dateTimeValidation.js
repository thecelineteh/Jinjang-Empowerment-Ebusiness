function validateDateTime() {
  if (document.activeElement.id == 'updateJobBtn'){
    var startDate = document.forms["editJobForm"]["startDate"].value;
    var endDate = document.forms["editJobForm"]["endDate"].value;
    var startTime = document.forms["editJobForm"]["startTime"].value;
    var endTime = document.forms["editJobForm"]["endTime"].value;

    if (endDate < startDate) {
      alert('Job end date cannot be before start date!');
      return false;
    }
    if (endTime < startTime) {
      alert('Job end time cannot be before start time!');
      return false;
    }

    if ((startDate == endDate) && (startTime == endTime)) {
      alert('Job cannot start and end at the same time on the same day!');
      return false;
    }
  }
}

function validateDateTimeCreate() {
  if (document.activeElement.id == 'createJobBtn') {
    var startDate = document.forms["postJobForm"]["startDate"].value;
    var endDate = document.forms["postJobForm"]["endDate"].value;
    var startTime = document.forms["postJobForm"]["startTime"].value;
    var endTime = document.forms["postJobForm"]["endTime"].value;

    if (endDate < startDate) {
      alert('Job end date cannot be before start date!');
      return false;
    }
    if (endTime < startTime) {
      alert('Job end time cannot be before start time!');
      return false;
    }

    if ((startDate == endDate) && (startTime == endTime)) {
      alert('Job cannot start and end at the same time on the same day!');
      return false;
    }
  }
}
