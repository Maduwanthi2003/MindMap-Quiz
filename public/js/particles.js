const canvas = document.getElementById('particles-bg');
const ctx = canvas.getContext('2d');

function resizeCanvas() {
    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas);

const colors = ['#9b6bff', '#4dd0e1', '#7b5cff', '#3ad6c9'];
const particleCount = 60;
const particles = [];

for (let i = 0; i < particleCount; i++) {
    particles.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        radius: Math.random() * 2 + 1,
        color: colors[Math.floor(Math.random() * colors.length)],
        vx: (Math.random() - 0.5) * 0.4,
        vy: (Math.random() - 0.5) * 0.4
    });
}

function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw connecting lines between nearby particles
    for (let i = 0; i < particles.length; i++) {
        for (let j = i + 1; j < particles.length; j++) {
            const dx = particles[i].x - particles[j].x;
            const dy = particles[i].y - particles[j].y;
            const dist = Math.sqrt(dx * dx + dy * dy);

            if (dist < 140) {
                ctx.beginPath();
                ctx.strokeStyle = `rgba(155, 107, 255, ${1 - dist / 140})`;
                ctx.lineWidth = 0.5;
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(particles[j].x, particles[j].y);
                ctx.stroke();
            }
        }
    }

    // Draw and move particles
    particles.forEach(p => {
        ctx.beginPath();
        ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
        ctx.fillStyle = p.color;
        ctx.fill();

        p.x += p.vx;
        p.y += p.vy;

        // Bounce off edges
        if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
        if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
    });

    requestAnimationFrame(animate);
}

animate();

// VARK section particles
const canvas2 = document.getElementById('particles-vark');
if (canvas2) {
    const ctx2 = canvas2.getContext('2d');

    function resizeCanvas2() {
        canvas2.width = canvas2.offsetWidth;
        canvas2.height = canvas2.offsetHeight;
    }
    resizeCanvas2();
    window.addEventListener('resize', resizeCanvas2);

    const particles2 = [];
    for (let i = 0; i < 50; i++) {
        particles2.push({
            x: Math.random() * canvas2.width,
            y: Math.random() * canvas2.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }

    function animate2() {
        ctx2.clearRect(0, 0, canvas2.width, canvas2.height);

        for (let i = 0; i < particles2.length; i++) {
            for (let j = i + 1; j < particles2.length; j++) {
                const dx = particles2[i].x - particles2[j].x;
                const dy = particles2[i].y - particles2[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < 140) {
                    ctx2.beginPath();
                    ctx2.strokeStyle = `rgba(155, 107, 255, ${1 - dist / 140})`;
                    ctx2.lineWidth = 0.5;
                    ctx2.moveTo(particles2[i].x, particles2[i].y);
                    ctx2.lineTo(particles2[j].x, particles2[j].y);
                    ctx2.stroke();
                }
            }
        }

        particles2.forEach(p => {
            ctx2.beginPath();
            ctx2.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx2.fillStyle = p.color;
            ctx2.fill();

            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0 || p.x > canvas2.width) p.vx *= -1;
            if (p.y < 0 || p.y > canvas2.height) p.vy *= -1;
        });

        requestAnimationFrame(animate2);
    }

    animate2();
}

// Features section particles
const canvas3 = document.getElementById('particles-features');
if (canvas3) {
    const ctx3 = canvas3.getContext('2d');

    function resizeCanvas3() {
        canvas3.width = canvas3.offsetWidth;
        canvas3.height = canvas3.offsetHeight;
    }
    resizeCanvas3();
    window.addEventListener('resize', resizeCanvas3);

    const particles3 = [];
    for (let i = 0; i < 50; i++) {
        particles3.push({
            x: Math.random() * canvas3.width,
            y: Math.random() * canvas3.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }

    function animate3() {
        ctx3.clearRect(0, 0, canvas3.width, canvas3.height);

        for (let i = 0; i < particles3.length; i++) {
            for (let j = i + 1; j < particles3.length; j++) {
                const dx = particles3[i].x - particles3[j].x;
                const dy = particles3[i].y - particles3[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < 140) {
                    ctx3.beginPath();
                    ctx3.strokeStyle = `rgba(155, 107, 255, ${1 - dist / 140})`;
                    ctx3.lineWidth = 0.5;
                    ctx3.moveTo(particles3[i].x, particles3[i].y);
                    ctx3.lineTo(particles3[j].x, particles3[j].y);
                    ctx3.stroke();
                }
            }
        }

        particles3.forEach(p => {
            ctx3.beginPath();
            ctx3.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx3.fillStyle = p.color;
            ctx3.fill();

            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0 || p.x > canvas3.width) p.vx *= -1;
            if (p.y < 0 || p.y > canvas3.height) p.vy *= -1;
        });

        requestAnimationFrame(animate3);
    }

    animate3();
}

// How It Works section particles
const canvas4 = document.getElementById('particles-how');
if (canvas4) {
    const ctx4 = canvas4.getContext('2d');

    function resizeCanvas4() {
        canvas4.width = canvas4.offsetWidth;
        canvas4.height = canvas4.offsetHeight;
    }
    resizeCanvas4();
    window.addEventListener('resize', resizeCanvas4);

    const particles4 = [];
    for (let i = 0; i < 50; i++) {
        particles4.push({
            x: Math.random() * canvas4.width,
            y: Math.random() * canvas4.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }

    function animate4() {
        ctx4.clearRect(0, 0, canvas4.width, canvas4.height);

        for (let i = 0; i < particles4.length; i++) {
            for (let j = i + 1; j < particles4.length; j++) {
                const dx = particles4[i].x - particles4[j].x;
                const dy = particles4[i].y - particles4[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);

                if (dist < 140) {
                    ctx4.beginPath();
                    ctx4.strokeStyle = `rgba(155, 107, 255, ${1 - dist / 140})`;
                    ctx4.lineWidth = 0.5;
                    ctx4.moveTo(particles4[i].x, particles4[i].y);
                    ctx4.lineTo(particles4[j].x, particles4[j].y);
                    ctx4.stroke();
                }
            }
        }

        particles4.forEach(p => {
            ctx4.beginPath();
            ctx4.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx4.fillStyle = p.color;
            ctx4.fill();

            p.x += p.vx;
            p.y += p.vy;

            if (p.x < 0 || p.x > canvas4.width) p.vx *= -1;
            if (p.y < 0 || p.y > canvas4.height) p.vy *= -1;
        });

        requestAnimationFrame(animate4);
    }

    animate4();
}


window.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('particles-login');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    function resize() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);

    const colors = ['#9b6bff', '#4dd0e1', '#7b5cff', '#3ad6c9'];
    const particles = [];

    for (let i = 0; i < 60; i++) {
        particles.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.5,
            vy: (Math.random() - 0.5) * 0.5
        });
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x;
                const dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 140) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(155,107,255,${1 - dist/140})`;
                    ctx.lineWidth = 0.5;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }

        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = p.color;
            ctx.fill();
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > canvas.width)  p.vx *= -1;
            if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
        });

        requestAnimationFrame(animate);
    }

    animate();
});


// Dashboard particles
const canvasDash = document.getElementById('particles-dashboard');
if (canvasDash) {
    const ctxDash = canvasDash.getContext('2d');

    function resizeDash() {
        canvasDash.width = window.innerWidth;
        canvasDash.height = window.innerHeight;
    }
    resizeDash();
    window.addEventListener('resize', resizeDash);

    const particlesDash = [];
    for (let i = 0; i < 50; i++) {
        particlesDash.push({
            x: Math.random() * canvasDash.width,
            y: Math.random() * canvasDash.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }

    function animateDash() {
        ctxDash.clearRect(0, 0, canvasDash.width, canvasDash.height);

        for (let i = 0; i < particlesDash.length; i++) {
            for (let j = i + 1; j < particlesDash.length; j++) {
                const dx = particlesDash[i].x - particlesDash[j].x;
                const dy = particlesDash[i].y - particlesDash[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 140) {
                    ctxDash.beginPath();
                    ctxDash.strokeStyle = `rgba(155,107,255,${1 - dist/140})`;
                    ctxDash.lineWidth = 0.5;
                    ctxDash.moveTo(particlesDash[i].x, particlesDash[i].y);
                    ctxDash.lineTo(particlesDash[j].x, particlesDash[j].y);
                    ctxDash.stroke();
                }
            }
        }

        particlesDash.forEach(p => {
            ctxDash.beginPath();
            ctxDash.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctxDash.fillStyle = p.color;
            ctxDash.fill();
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > canvasDash.width)  p.vx *= -1;
            if (p.y < 0 || p.y > canvasDash.height) p.vy *= -1;
        });

        requestAnimationFrame(animateDash);
    }
    animateDash();
}


// Admin page particles
const canvasAdmin = document.getElementById('particles-admin');
if (canvasAdmin) {
    const ctxAdmin = canvasAdmin.getContext('2d');

    function resizeAdmin() {
        canvasAdmin.width = window.innerWidth;
        canvasAdmin.height = window.innerHeight;
    }
    resizeAdmin();
    window.addEventListener('resize', resizeAdmin);

    const particlesAdmin = [];
    for (let i = 0; i < 50; i++) {
        particlesAdmin.push({
            x: Math.random() * canvasAdmin.width,
            y: Math.random() * canvasAdmin.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }

    function animateAdmin() {
        ctxAdmin.clearRect(0, 0, canvasAdmin.width, canvasAdmin.height);

        for (let i = 0; i < particlesAdmin.length; i++) {
            for (let j = i + 1; j < particlesAdmin.length; j++) {
                const dx = particlesAdmin[i].x - particlesAdmin[j].x;
                const dy = particlesAdmin[i].y - particlesAdmin[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 140) {
                    ctxAdmin.beginPath();
                    ctxAdmin.strokeStyle = `rgba(155,107,255,${1 - dist/140})`;
                    ctxAdmin.lineWidth = 0.5;
                    ctxAdmin.moveTo(particlesAdmin[i].x, particlesAdmin[i].y);
                    ctxAdmin.lineTo(particlesAdmin[j].x, particlesAdmin[j].y);
                    ctxAdmin.stroke();
                }
            }
        }

        particlesAdmin.forEach(p => {
            ctxAdmin.beginPath();
            ctxAdmin.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctxAdmin.fillStyle = p.color;
            ctxAdmin.fill();
            p.x += p.vx;
            p.y += p.vy;
            if (p.x < 0 || p.x > canvasAdmin.width)  p.vx *= -1;
            if (p.y < 0 || p.y > canvasAdmin.height) p.vy *= -1;
        });

        requestAnimationFrame(animateAdmin);
    }
    animateAdmin();
}


// Lecturer page particles
const canvasLec = document.getElementById('particles-lecturer');
if (canvasLec) {
    const ctxLec = canvasLec.getContext('2d');
    function resizeLec() {
        canvasLec.width = window.innerWidth;
        canvasLec.height = window.innerHeight;
    }
    resizeLec();
    window.addEventListener('resize', resizeLec);
    const particlesLec = [];
    for (let i = 0; i < 50; i++) {
        particlesLec.push({
            x: Math.random() * canvasLec.width,
            y: Math.random() * canvasLec.height,
            radius: Math.random() * 2 + 1,
            color: colors[Math.floor(Math.random() * colors.length)],
            vx: (Math.random() - 0.5) * 0.4,
            vy: (Math.random() - 0.5) * 0.4
        });
    }
    function animateLec() {
        ctxLec.clearRect(0, 0, canvasLec.width, canvasLec.height);
        for (let i = 0; i < particlesLec.length; i++) {
            for (let j = i + 1; j < particlesLec.length; j++) {
                const dx = particlesLec[i].x - particlesLec[j].x;
                const dy = particlesLec[i].y - particlesLec[j].y;
                const dist = Math.sqrt(dx*dx + dy*dy);
                if (dist < 140) {
                    ctxLec.beginPath();
                    ctxLec.strokeStyle = `rgba(155,107,255,${1 - dist/140})`;
                    ctxLec.lineWidth = 0.5;
                    ctxLec.moveTo(particlesLec[i].x, particlesLec[i].y);
                    ctxLec.lineTo(particlesLec[j].x, particlesLec[j].y);
                    ctxLec.stroke();
                }
            }
        }
        particlesLec.forEach(p => {
            ctxLec.beginPath();
            ctxLec.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctxLec.fillStyle = p.color;
            ctxLec.fill();
            p.x += p.vx; p.y += p.vy;
            if (p.x < 0 || p.x > canvasLec.width)  p.vx *= -1;
            if (p.y < 0 || p.y > canvasLec.height) p.vy *= -1;
        });
        requestAnimationFrame(animateLec);
    }
    animateLec();
}