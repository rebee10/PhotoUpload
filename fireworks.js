// fireworks.js
document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.createElement('canvas');
    document.body.appendChild(canvas);
    var ctx = canvas.getContext('2d');
    var particles = [];
    var particleCount = 100;
    var colors = ['#ff0000', '#00ff00', '#0000ff', '#ffff00', '#ff00ff', '#00ffff'];

    // Resize canvas
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    // Create particles
    for (var i = 0; i < particleCount; i++) {
        particles.push({
            x: canvas.width / 2,
            y: canvas.height / 2,
            boxW: randomRange(5, 20),
            boxH: randomRange(5, 20),
            size: randomRange(2, 8),
            spikeran: randomRange(3, 5),
            velX: randomRange(-8, 8),
            velY: randomRange(-50, -10),
            angle: convertToRadians(randomRange(0, 360)),
            color: colors[Math.floor(Math.random() * colors.length)],
            anglespin: randomRange(-0.2, 0.2),
            draw: function () {
                ctx.save();
                ctx.translate(this.x, this.y);
                ctx.rotate(this.angle);
                ctx.fillStyle = this.color;
                ctx.beginPath();
                // Draw a rectangle shape particle
                ctx.fillRect(this.boxW / 2 * -1, this.boxH / 2 * -1, this.boxW, this.boxH);
                ctx.fill();
                ctx.closePath();
                ctx.restore();
                this.angle += this.anglespin;
                this.velY *= 0.999;
                this.velY += 0.3;
                this.x += this.velX;
                this.y += this.velY;
                if (this.y < 0) {
                    this.velY *= -0.2;
                    this.velX *= 0.9;
                };
                if (this.y > canvas.height) {
                    this.anglespin = 0;
                    this.y = canvas.height;
                    this.velY *= -0.2;
                    this.velX *= 0.9;
                };
                if (this.x > canvas.width || this.x < 0) {
                    this.velX *= -0.5;
                };
            },
        });
    }

    function drawScreen() {
        ctx.globalAlpha = 1;
        for (var i = 0; i < particles.length; i++) {
            particles[i].draw();
        }
    }

    function update() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        drawScreen();
        requestAnimationFrame(update);
    }

    update();

    function randomRange(min, max) {
        return min + Math.random() * (max - min);
    }

    function convertToRadians(degree) {
        return degree * (Math.PI / 180);
    }

    function drawStar(ctx, x, y, spikes, outerRadius, innerRadius, color) {
        var rot = Math.PI / 2 * 3;
        var x = x;
        var y = y;
        var step = Math.PI / spikes;

        ctx.strokeSyle = "#000";
        ctx.beginPath();
        ctx.moveTo(x, y - outerRadius)
        for (i = 0; i < spikes; i++) {
            x = x + Math.cos(rot) * outerRadius;
            y = y + Math.sin(rot) * outerRadius;
            ctx.lineTo(x, y)
            rot += step

            x = x + Math.cos(rot) * innerRadius;
            y = y + Math.sin(rot) * innerRadius;
            ctx.lineTo(x, y)
            rot += step
        }
        ctx.lineTo(x, y - outerRadius)
        ctx.closePath();
        ctx.fillStyle = color;
        ctx.fill();
    }
});
