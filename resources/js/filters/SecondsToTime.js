import Vue from 'vue';

// Vue.filter('secondsToTime', function (totalSeconds) {
// 	const hours =  parseInt(Math.floor(totalSeconds / 3600))
// 	const minutes = parseInt(Math.floor((totalSeconds - (hours * 3600)) / 60))
// 	const seconds= parseInt((totalSeconds - ((hours * 3600) + (minutes * 60))) % 60)

// 	const dHours = (hours > 9 ? hours : '0' + hours)
// 	const dMins = (minutes > 9 ? minutes : '0' + minutes)
// 	const dSecs = (seconds > 9 ? seconds : '0' + seconds)

// 	return (dHours === '00' ? '' : dHours + ':')
// 		+ dMins + ':'
// 		+ dSecs
// });
  
Vue.filter('secondsToTime', function (t) {
	if (isNaN(parseFloat(t))) return '00:00'
	let h = padZero(parseInt((t / (60 * 60)) % 24)) + ":"
	h = h === '00:' ? '' : h
	return h +
		padZero(parseInt((t / (60)) % 60)) + ":" + 
		padZero(parseInt((t) % 60))

	function padZero(v) {
		return (v < 10) ? "0" + v : v
	}
});