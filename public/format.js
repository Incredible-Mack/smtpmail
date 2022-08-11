const editor = document.getElementById('editor')
const boldButton = document.getElementById('boldButton');
const italicButton = document.getElementById('italicButton');
const underlineButton = document.getElementById('underlineButton');
const undoButton = document.getElementById('undoButton');
const redoButton = document.getElementById('redoButton');
const history = {
  back: [],
  forward: []
};

function performAction (command) {
  if (!history.back.length || history.back[history.back.length - 1] != editor.innerHTML) {
    history.back.push(editor.innerHTML);
  }
  document.execCommand(command, false, null);
  editor.focus();
}

boldButton.addEventListener('click', function () {
  performAction('bold');
});

italicButton.addEventListener('click', function () {
  performAction('italic');
});

underlineButton.addEventListener('click', function () {
  performAction('underline');
});

undoButton.addEventListener('click', function () {
  if (!history.back.length) {
    return;
  }
  history.forward.push(editor.innerHTML);
  editor.innerHTML = history.back.pop();
  editor.focus();
});

redoButton.addEventListener('click', function () {
  if (!history.forward.length) {
    return;
  } history.back.push(editor.innerHTML);
  editor.innerHTML = history.forward.pop();
  editor.focus();
});

editor.addEventListener('keydown', function () {
  history.forward.length = [];
  history.back.push(editor.innerHTML);
});