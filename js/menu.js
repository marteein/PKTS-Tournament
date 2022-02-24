function increaseValue(a) {
  var value = parseInt(document.getElementById('cafe'+a).value, 10);
  value = isNaN(value) ? 0 : value;
  value++;
  document.getElementById('cafe'+a).value = value;
}

function decreaseValue(a) {
  var value = parseInt(document.getElementById('cafe'+a).value, 10);
  value = isNaN(value) ? 0 : value;
  value < 1 ? value = 1 : '';
  value--;
  document.getElementById('cafe'+a).value = value;
}