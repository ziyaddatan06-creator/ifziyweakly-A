const { exec } = require('child_process');
const os = require('os');
const path = require('path');

const PORT = 8000;
const HOST = 'localhost';
const URL = `http://${HOST}:${PORT}`;

console.log('\n✨ Starting PHP Development Server...\n');
console.log(`🚀 Server is running at: ${URL}`);
console.log(`📍 Press Ctrl+Click on the link above to open in browser`);
console.log(`⛔ Press Ctrl+C to stop the server\n`);

const phpPath = path.join('D:', 'laragon', 'bin', 'php', 'php-8.3.30-Win32-vs16-x64', 'php.exe');
const command = `"${phpPath}" -S ${HOST}:${PORT}`;

const server = exec(command, (error, stdout, stderr) => {
  if (error) {
    console.error(`Error: ${error.message}`);
    return;
  }
  if (stderr) {
    console.error(stderr);
  }
});

server.stdout.on('data', (data) => {
  console.log(data.toString());
});

server.stderr.on('data', (data) => {
  console.error(data.toString());
});

process.on('SIGINT', () => {
  console.log('\n\n🛑 Server stopped');
  process.exit(0);
});
