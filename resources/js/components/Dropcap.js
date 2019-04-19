import addElement from '../functions/AddElement.js';

export default function() {
    const dropcapB = document.querySelector('.-drop-cap');

    if (typeof(dropcapB) != 'undefined' && dropcapB != null) {
        const dropcapP = dropcapB.querySelector('p:first-of-type'),
            dropcapT = dropcapP.textContent,
            dropcapL = dropcapT.charAt(0),
            dropcapT_short = dropcapT.substring(1), 
            dropcapP_replaced = '<style>.drop-cap::before { content: "' + dropcapL + '" }</style><span class="drop-cap"></span>' + dropcapT_short;

        dropcapB.removeChild(dropcapP)
        addElement(dropcapB, 'p', dropcapP_replaced)
    }
}   