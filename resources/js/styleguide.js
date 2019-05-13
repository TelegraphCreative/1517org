require('prismjs/components/prism-markdown.js')
require('prismjs/components/prism-markup-templating.js')
require('prismjs/components/prism-markup.js')
require('prismjs/components/prism-twig.js')
// require('prismjs/components/prism-css.js')
// require('prismjs/components/prism-javascript.js')
require('prismjs/themes/prism-tomorrow.css')
require('prismjs/plugins/toolbar/prism-toolbar')
require('prismjs/plugins/toolbar/prism-toolbar.css')
import Prism from 'prismjs'

Prism.plugins.toolbar.registerButton('select-code', function(env) {
    var button = document.createElement('button')
    button.innerHTML = 'Select Code'

    button.addEventListener('click', function() {
        // Source: http://stackoverflow.com/a/11128179/2757940
        if (document.body.createTextRange) {
            // ms
            var range = document.body.createTextRange()
            range.moveToElementText(env.element)
            range.select()
        } else if (window.getSelection) {
            // moz, opera, webkit
            var selection = window.getSelection()
            var range = document.createRange()
            range.selectNodeContents(env.element)
            selection.removeAllRanges()
            seœlection.addRange(range)
        }
    })

    return button
})

Prism.highlightAll()
