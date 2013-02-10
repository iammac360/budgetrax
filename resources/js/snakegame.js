var clearCanvas = false;
var CONST_frameLength = 500;
var frameLength = CONST_frameLength;

// Use this function clear all canvas elements
function clearCanvasElements() {
	if(clearCanvas && project.activeLayer.hasChildren()) {
		project.activeLayer.removeChildren();
		clearCanvas = false;
	}
}

function onFrame(event) {
	
}

setInterval(function() {
	clearCanvasElements();
	Snake.advance();
	Snake.draw();
}, CONST_frameLength);

var Snake = function () {
	var blockSize = 10;
	var posArray = [];
	posArray.push([6, 4]);
	posArray.push([5, 4]);
	posArray.push([4, 4]);
	var direction = 'right';
	console.log(posArray);

	function drawSection(path, position) {
		var x = blockSize * position[0];
		var y = blockSize * position[1];
		path.add(new Point(x, y));
	}

	function draw() {
		var snakeBody = new Path();
		snakeBody.style = {
			strokeColor: snake_data.color,
			strokeWidth: blockSize,
			strokeCap: 'round'
		};
		snakeBody.selected = true;
		for(var i = 0; i < posArray.length; i++) {
			drawSection(snakeBody, posArray[i]);
		}

		clearCanvas = true;
	}

	function advance() {
		var nextPosition = posArray[0].slice(); // Copy head of snake
		nextPosition[0] += 1; // Add 1 to the x position

		// Add the new position to tthe beginning of the array
		posArray.unshift(nextPosition);
		// and remove the last position
		posArray.pop();
	}

	return {
		draw: draw,
		advance: advance
	};
};

