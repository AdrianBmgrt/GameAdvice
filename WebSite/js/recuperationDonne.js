var xhr = new XMLHttpRequest();
xhr.open('GET', 'https://jsonplaceholder.typicode.com/users/1');
xhr.onreadystatechange = function() {
    if (xhr.readyState === 4) {
        alert(xhr.responseText);
    }
};
xhr.send();