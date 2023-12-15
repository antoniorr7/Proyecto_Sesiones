<h1>bienvenido a juego1</h1>


<canvas></canvas>

<style>
        h1{
                position:absolute;
                top:10%;
                z-index: 10;
        }
        body {
  margin:0;
  background: #ae2633;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

canvas {
  opacity: 0;
  background: #ae2633;
  animation: fadeIn 1s ease-in-out 0.3s 1 forwards;
}
</style>
<script>const canvas = document.querySelector('canvas');
const ctx = canvas.getContext('2d');
const faceWithWhiteEyes = new Image();
const iris = new Image();
const faceMask = new Image();
const mousePosition = { x: 0, y: 0 };
const eyeRadius = 18;

faceWithWhiteEyes.src = 'https://cdn.glitch.com/9d4b14c4-1e9d-4545-8c82-e3a512c599b1%2Fdali-white-eyes.png?v=1595780994034';
iris.src = 'https://cdn.glitch.com/9d4b14c4-1e9d-4545-8c82-e3a512c599b1%2Firis.png?v=1595781818095';
faceMask.src = 'https://cdn.glitch.com/9d4b14c4-1e9d-4545-8c82-e3a512c599b1%2Fdali-mask.png?v=1595784436890';

function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
  ctx.height = canvas.height;
  ctx.width = canvas.width;
}

function drawFaceWithWhiteEyes() {
  const x = canvas.width / 2 - faceWithWhiteEyes.width / 2;
  const y = canvas.height / 2 - faceWithWhiteEyes.height / 2;
  ctx.drawImage(faceWithWhiteEyes, x, y);
}

function drawFaceMask() {
  const x = canvas.width / 2 - faceMask.width / 2;
  const y = canvas.height / 2 - faceMask.height / 2;
  ctx.drawImage(faceMask, x, y);
}

function distance(a, b) {
  return Math.sqrt(Math.pow(b.x - a.x, 2) + Math.pow(b.y - a.y, 2));
}

function getUnitVector(a, b) {
  const module = distance(a,b);
  return {
    x: (b.x - a.x) / module,
    y: (b.y - a.y) / module
  };
}

function getTranslatedPosition(eyePosition) {
  if (distance(eyePosition, mousePosition) <= eyeRadius) {
    return mousePosition;
  }
  const unitVector = getUnitVector(eyePosition, mousePosition);
  return {
    x: eyePosition.x + eyeRadius * Math.sin(unitVector.x),
    y: eyePosition.y + eyeRadius * Math.sin(unitVector.y),
  };
}

function drawEyes() {
  const eyeOriginPositions = [
    {
      x: canvas.width / 2  - 70,
      y: canvas.height / 2 - 12,
    },
    {
      x: canvas.width / 2 + 55,
      y: canvas.height / 2 - 12,
    }
  ];
  
  const eyePositions = eyeOriginPositions.map(getTranslatedPosition);
  
  eyePositions.forEach((eyePosition) => {
    ctx.drawImage(iris, 
                  eyePosition.x - iris.width / 2, 
                  eyePosition.y - iris.height / 2);
  });
}

function clearCanvas() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);  
}

function render() {
  clearCanvas();
  drawFaceWithWhiteEyes();
  drawEyes();
  drawFaceMask();
}

function onResize() {
  resizeCanvas();
  render();
}

function onMouseMove(event) {
  mousePosition.x = event.offsetX;
  mousePosition.y = event.offsetY;
  render();
}

function onTouchMove(event) {
  mousePosition.x = event.touches[0].clientX;
  mousePosition.y = event.touches[0].clientY;
  render();
}

function main() {
  resizeCanvas();
  render();
  window.addEventListener('resize', onResize);
  window.addEventListener('mousemove', onMouseMove);
  window.addEventListener('touchmove', onTouchMove);
}

window.addEventListener('load', main);</script>