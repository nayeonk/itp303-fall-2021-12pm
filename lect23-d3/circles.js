/*
    References: http://bl.ocks.org/alansmithy/e984477a741bc56db5a5
*/

// Global State
var dataArray = [
    [30, 35, 45, 55, 70],
    [50, 55, 45, 35, 20, 25, 25, 40]
];

var dataIndex = 0;

const xBuffer = 50;
const yBuffer = 150;
const lineLength = 400;

// Create main svg element
let svgDoc = d3.select(".row")
    .append("div")
    .classed("col-12 text-center", true)
    .append("svg")
    .attr("width", 500)
    .attr("height", 250)

// Add Title
svgDoc.append("text")
    .attr("x", xBuffer + (lineLength / 2))
    .attr("y", 50)
    .text(`Dataset ${dataIndex + 1}`);

// Create axis line
svgDoc.append("line")
    .attr("x1", xBuffer)
    .attr("y1", yBuffer)
    .attr("x1", xBuffer + lineLength)
    .attr("y2", yBuffer)

// Calculates x coordinate on line for circle
let calculateCX = (data, index) => {
    let spacing = lineLength / (dataArray[dataIndex].length);
    return xBuffer + (index * spacing);
}

// Calculates the radius for a circle
let calculateRadius = (data, index) => data;

// Create circles
svgDoc.append("g")
    .selectAll("circle")
    .data(dataArray[dataIndex])
    .enter()
    .append("circle")
    .attr("cx", calculateCX)
    .attr("cy", yBuffer)
    .attr("r", calculateRadius);

// Change Button
let changeButton = d3.select(".row")
    .append("div")
    .classed("col-12 text-center", true)
    .append("button")
    .classed("btn btn-primary", true)
    .text("Change Data");

// When the change button is clicked, switch the dataset and animate between the circles.
changeButton.on("click", () => {
    // Change index of data
    if (dataIndex === 0) {
        dataIndex = 1;
    } else {
        dataIndex = 0;
    }

    updateCircles();
});

var updateCircles = () => {
    // Update data array
    let circles = svgDoc.select("g")
        .selectAll("circle")
        .data(dataArray[dataIndex]);
    
    // Create any new circles if needed
    newCircles = circles.enter()
        .append("circle")
        .attr("cx", lineLength)
        .attr("cy", yBuffer)
        .attr("r", 0);

    // Remove unneeded circles
    circles.exit()
        .remove();

    // Update all circles to new positions
    circles.transition()
        .duration(500)
        .attr("cx", calculateCX)
        .attr("cy", yBuffer)
        .attr("r", calculateRadius);

    newCircles.transition()
        .duration(500)
        .attr("cx", calculateCX)
        .attr("cy", yBuffer)
        .attr("r", calculateRadius);

    /* TODO  */
    d3.select("text")
        .text(`Dataset ${dataIndex + 1}`);
}
