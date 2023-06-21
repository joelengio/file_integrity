const { app, BrowserWindow, dialog } = require('electron');
const crypto = require('crypto');
const fs = require('fs');
const path = require('path');

let mainWindow;

function createWindow() {
  mainWindow = new BrowserWindow({
    width: 800,
    height: 600,
    webPreferences: {
      nodeIntegration: true
    }
  });

  mainWindow.loadFile('login.html');

  mainWindow.on('closed', function () {
    mainWindow = null;
  });
}

app.on('ready', createWindow);

app.on('window-all-closed', function () {
  if (process.platform !== 'darwin') {
    app.quit();
  }
});

app.on('activate', function () {
  if (mainWindow === null) {
    createWindow();
  }
});

function checkIntegrity() {
  dialog.showOpenDialog(mainWindow, {
    properties: ['openFile']
  }).then(result => {
    if (!result.canceled) {
      const filePath = result.filePaths[0];
      const fileData = fs.readFileSync(filePath);
      const fileHash = crypto.createHash('sha256').update(fileData).digest('hex');

      dialog.showMessageBox(mainWindow, {
        type: 'info',
        title: 'File Integrity Checker',
        message: `The SHA-256 hash of ${path.basename(filePath)} is:\n\n${fileHash}`
      });
    }
  });
}
