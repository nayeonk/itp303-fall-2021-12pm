// Write JS here!!

// Writing a separate function that takes care of displaying results
function displayResults(results) {
    console.log(results);

    // Clear out all the results before appending new results
    let tbody = document.querySelector("tbody");
    while(tbody.hasChildNodes()) {
        tbody.removeChild( tbody.lastChild);
    }

    // Received a response as a JSON formatted string. Can easily convert JSON string into JS objects so that JS can easily pick out the info we need from the results
    let convertedResults = JSON.parse(results);
    console.log(convertedResults);
    // Using dot notation, can now grab any piece of information that iTunes gives me
    console.log(convertedResults.results[0].artistName);

    // Show actual numbers of results
    document.querySelector("#num-results").innerHTML = convertedResults.resultCount;

    // For ever result, add a <tr> to the table to display the result
    for( let i = 0; i < convertedResults.results.length; i++ ) {
        //document.createElement("tr");

        let htmlString = `
        <tr>
			<td>
                <img src="${convertedResults.results[i].artworkUrl100}">
            </td>
			<td>${convertedResults.results[i].artistName}</td>
			<td>${convertedResults.results[i].trackName}</td>
			<td>${convertedResults.results[i].collectionName}</td>
			<td>
                <audio src="${convertedResults.results[i].previewUrl}" controls>
                </audio>
            </td>
		</tr>
        `;

        // Append this <tr> string to the table via <tbody>
        document.querySelector("tbody").innerHTML += htmlString;
    }

}

function ajaxRequest(endpoint, returnFunction) {
    // Use AJAX to make a request to the iTunes API endpoint
    // We will be using XMLHttpRequest objects to make ajax requests
    // Note: there are other ways to make AJAX requests. fetch api is one of them.
    
    let httpRequest = new XMLHttpRequest();

    // .open() starts a request.
    // 1st param: the method, GET or POST (depends on the API)
    // 2nd param: the endpoint to make the request to
    httpRequest.open("GET", endpoint);

    // .send() sends the request!
    httpRequest.send();

    // don't know when iTunes is going to send a response. No need to wait around.
    // Set up a "notification." This function will be called when iTunes eventually gives a response back
    httpRequest.onreadystatechange = function() {
        // This function runs when iTunes gives us some kind of response back
        console.log("got a response!!!");
        console.log(httpRequest.readyState);

        // When the response reqaches the 4th state, it means it's ready for us to use!
        if(httpRequest.readyState == 4) {
            // Some kind of response has been received
            // Can check here if there is an error or not. Status code 200 means everything is succesful
            if(httpRequest.status == 200) {
                //.responseText returns the string of the response that was received
                //console.log(httpRequest.responseText);

                // Results were received!! Let's display the results now. In a separate function.
                returnFunction(httpRequest.responseText);

            }
            else {
                console.log("AJAX error!");
                console.log(httpRequest.status);
            }
        }
    }

    console.log("moving along...");
}

// Event handler for when the form is submitted
document.querySelector("#search-form").onsubmit = function(event) {
    event.preventDefault();

    // Grab the user input
    let searchInput = document.querySelector("#search-id").value.trim();

    // Grab the limit from dropdown
    let limitInput = document.querySelector("#limit-id").value;

    console.log(searchInput);
    console.log(limitInput);

    // This endpoint is from the iTunes documentation
    // .encodeURIComponent() method takes care of special characters such as space. It replaces them with special characters that work for URLs
    let endpoint = "https://itunes.apple.com/search?term=" + encodeURIComponent(searchInput) + "&limit=" + limitInput;

    // Call the ajaxRequestfunction
    // 1st param: the endpoint to call iTunes
    // 2nd param: the function to call when a response is received from iTunes
    ajaxRequest(endpoint, displayResults);

}