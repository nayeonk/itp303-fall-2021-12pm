// Margins of the graph
const margin = {
    top: 10, 
    right: 30, 
    bottom: 30, 
    left: 60
};

// Graph Dimensions
const width = 768 - margin.left - margin.right;
const height = 600 - margin.top - margin.bottom;
    
// Append the SVG object to the div with the id 'scatter'
/* TODO */
let svg = d3.select("#scatter")
            .append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", `translate(${margin.left}, ${margin.top})`);


// Read the data
async function createPlot() {
    // Read the data from the CSV
    const data = await d3.csv("data.csv");

    console.log(data);

    /* TODO */
    let xMax = d3.max(data, function(datapoint) { return parseInt(datapoint.GrLivArea); });
    let yMax = d3.max(data, function(datapoint) { return parseInt(datapoint.SalePrice); });
    console.log(xMax);
    console.log(yMax);
    
    // Linear equation of X axis with domain and range
    let xAxis = d3.scaleLinear([0, xMax], [0, width]);
    // Linear equation of Y axis with domain and range
    let yAxis = d3.scaleLinear([0, yMax], [height, 0]);
    console.log(xAxis);
    console.log(yAxis);

    svg.append("g")
        .attr("transform", `translate(0, ${height})`)
        .call(d3.axisBottom(xAxis));
    
    svg.append("g")
        .call(d3.axisLeft(yAxis));

    // Add circle for each data point    
    svg.append("g")
        .selectAll("dot")
        .data(data)
        .join("circle")
        .attr("cx", function(datapoint) { return xAxis(datapoint.GrLivArea); })
        .attr("cy", function(datapoint) { return yAxis(datapoint.SalePrice); })
        .attr("r", 2)
        .style("fill", "red");
}

createPlot();