import InfiniteScroll from 'infinite-scroll'

export default function () {
    var pagination = document.querySelector('.pagination__next')
    var elem = document.querySelector('.page-entries')
    if (pagination) {
        var infScroll = new InfiniteScroll(elem, {
            // options
            path: '.pagination__next',
            append: '.content-card',
            hideNav: '.pagination',
            history: false
        })
    }
}