"use strict;"

var datal = {};

function createData(y, m, d, h) {
	//var y,m,d,h;
	var h2 = h + 1;
	
	//datal[y] = {};
	if(datal[y])
		console.log("");
	else
		datal[y] = {};
	//datal[y][m] = {};
	if(datal[y][m])
		console.log("");
	else
		datal[y][m] = {};
	//datal[y][m][d] = [];
	if(datal[y][m][d])
		console.log("");
	else
		datal[y][m][d] = [];
    try{
		datal[y][m][d].push(
			{
				startTime: h + ":00",
				endTime: h2 + ":00",
				text: "Rezervat"
			}
		);
	} catch(e){
		datal[y][m][d] = [];
		datal[y][m][d].push(
			{
				startTime: h + ":00",
				endTime: h2 + ":00",
				text: "Rezervat"
			}
		)
	}
}
