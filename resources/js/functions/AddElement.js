export default function(parent, elementTag, html) {
    var newElement = document.createElement(elementTag);
    newElement.innerHTML = html;
    parent.prepend(newElement);
}