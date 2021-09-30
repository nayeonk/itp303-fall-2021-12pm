// When the page loads for the first time, the following code will run

// Check the local storage to see if name or bg color exists
// localStorage.getItem() 
// 1st param: name of they key
// returns NULL if the key does not exist
let storedName = localStorage.getItem("name");
let storedBgcolor = localStorage.getItem("bgColor");

if(storedName) {
    // Name exists in the localStorage
    document.querySelector("#name-display").innerHTML = storedName;
}
if(storedBgcolor) {
    document.querySelector("body").style.backgroundColor = storedBgcolor;
}

// Create an empty array to store a list of fruits
let fruitArray = [];

// Grab the fruit information from storage
let fruitsInStorage = localStorage.getItem("fruits");
// Check if it's set or not
if(fruitsInStorage) {
    // Convert the fruit value back to JS array
    let fruits = JSON.parse(fruitsInStorage);

    // Set the converted fruits to the fruitArray
    fruitArray = fruits;

    // Clear the display
    document.querySelector("#fruitsDisplay").innerHTML = "";
    // Display the fruits!
    for( let i = 0; i <fruitArray.length; i++) {
        document.querySelector("#fruitsDisplay").innerHTML += fruitArray[i] + ", ";
    }

}
else {
    document.querySelector("#fruitsDisplay").innerHTML = "No fruits are saved";
}

// Fruit form submission handler
document.querySelector("#fruit-form").onsubmit = function(event) {
    event.preventDefault();

    let fruitInput = document.querySelector("#fruit").value.trim();

    fruitArray.push(fruitInput);
    console.log(fruitArray);

    // Save this array in the localStorage
    // Remember, localstorage CANNOT save arrays. Must be a string. This is where JSON strings come in handy.
    // JSON.parse() opposite is JSON.stringify()
    let fruitString = JSON.stringify(fruitArray);

    console.log(fruitString);
    
    // Save this string into local storage!!
    localStorage.setItem("fruits", fruitString);

    // Clear the display
    document.querySelector("#fruitsDisplay").innerHTML = "";

    // Display the fruits
    for(let i = 0; i < fruitArray.length; i++) {
        document.querySelector("#fruitsDisplay").innerHTML += fruitArray[i] + ", ";
    }

}



// Form submission handler
document.querySelector("#form").onsubmit = function(event) {
    event.preventDefault();

    let nameInput = document.querySelector("#name").value;
    let colorInput = document.querySelector("#bgcolor").value;

    // Based on user input, change the name and bg color
    document.querySelector("#name-display").innerHTML = nameInput;
    document.querySelector("body").style.backgroundColor = colorInput;

    // Save the user's input into local storage
    // .setItem() saves key/value pairs in the local storage
    // 1st param: the name of key
    // 2nd param: the value of key
    // local storage only stores strings for keys and values
    localStorage.setItem("name", nameInput);
    localStorage.setItem("bgColor", colorInput);


}