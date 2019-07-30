import InfiniteScroll from 'infinite-scroll'

export default function () {
    const pagination = document.querySelector('.pagination__next')
    const elem = document.querySelector('.page-entries')
    if (pagination) {
        const infScroll = new InfiniteScroll(elem, {
            // options
            path: '.pagination__next',
            append: '.content-card',
            hideNav: '.pagination',
            history: false
        })
    }
}