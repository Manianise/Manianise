function InstallEventHandler(selector, type, eventHandler) {
    var domObject = document.querySelector(selector);
    domObject.addEventListener(type, eventHandler);
}
