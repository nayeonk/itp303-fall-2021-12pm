/* TODO */

d3.select("#select")
    .on("click", function() {
        d3.select("body")
            .transition()
            .duration(500)
            .style("background-color", "red");
    });

d3.select("#transition")
    .on("click", () => {
        d3.selectAll("circle")
            .transition()
            .duration(250)
            .attr("r", function(data) { return data * 0.5; });
    });

d3.select("#dynamic")
    .on("click", () => {
        dataArray.push([20, 75, 50]);
        dataIndex = 2;
        updateCircles();
    });