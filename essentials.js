//Assuming URL is "https://gvelondon.com/cars/bugatti-veyron-sang-noir/"
var base_url = window.location.origin; //https://gvelondon.com
var host = window.location.host; //gvelondon.com
var pathArray = window.location.pathname.split('/'); //returns object ['', 'cars', ''] 
var urlParams = new URLSearchParams(window.location.search);

function qp_has(key) {
    return urlParams.has(key);
}

function qp_get(key) {
    return urlParams.get(key);
}

function qp_add(key, value) {
    return urlParams.append(key, value);
}