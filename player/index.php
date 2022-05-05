<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/webtorrent@latest/webtorrent.min.js"></script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #000000;
            position: relative;
            height: 100vh;
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            font-size: 13px;
            line-height: 1
        }

        .hide {
            display: none !important;
        }

        .flex-cont {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .flex-cont.full-height {
            height: 100%;
        }

        .flex-cont.column {
            flex-direction: column;
        }

        .flex-cont.space-around {
            justify-content: space-around;
        }

        .loader,
        .player {
            width: 100%;
            color: #fff;
        }

        .heading {
            text-align: center;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .loader {
            background: linear-gradient(180deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, .85) 40%, rgba(0, 0, 0, .85) 60%, rgba(0, 0, 0, 0.4) 100%);
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 99999
        }

        .loader.float {
            width: 210px;
            left: auto;
            right: 10px;
            top: 10px;
            height: 56px;
            background: transparent;
            font-size: 10px;
        }

        .loader.float .detail-box {
            padding: 10px;
        }

        .loader.float .detail-box .loading-text {
            font-size: 11px;
        }

        .loader.float .detail-box .progress-bar {
            margin: 5px 0;
            height: 3px;
        }

        body.active .loader.float {
            visibility: visible;
            opacity: 1;
            transition: all 0.4s ease;
        }

        body.inactive .loader.float {
            visibility: hidden;
            opacity: 0;
            transition: all 0.4s ease;
        }

        .loader .heading {
            padding-bottom: 15px
        }

        .loader .detail-box {
            background: rgba(0, 0, 0, 0.6);
            border-radius: 10px;
            padding: 15px 20px;
            max-width: 300px;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }

        .loader .detail-box .loading-text {
            font-size: 14px;
            text-align: center;
        }

        .loader .detail-box .progress-bar {
            height: 5px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 10px;
            margin: 10px 0;
            position: relative;
        }

        .loader .detail-box .progress-bar span {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            background-color: #fff;
            border-radius: 10px;
        }

        .player #player {
            width: 100%;
            height: 100%;
        }

        .player .controlls {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 100;
        }

        .player .loading {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(0, 0, 0, 0.8);
            align-items: center;
            font-size: 15px;
        }

        .player .loading img {
            width: 25px;
            margin-right: 10px;
        }

        body.active .player .controlls {
            opacity: 1;
            visibility: visible;
            transition: all 0.4s ease;
        }

        body.inactive .player .controlls {
            transition: all 0.4s ease;
            visibility: hidden;
            opacity: 0;
        }

        .player .heading {
            background: linear-gradient(rgba(0, 0, 0, .75), rgba(0, 0, 0, 0));
            padding: 30px 10px 40px;
        }

        .player .player-controlls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            align-items: center;
            display: flex;
            justify-content: flex-end;
            text-align: center;
            padding: 60px 10px 35px;
            background: linear-gradient(rgba(0, 0, 0, 0), rgba(0, 0, 0, .75));
            z-index: 100
        }

        .player .play-button {
            position: absolute;
            top: calc(50% - 35px);
            left: calc(50% - 35px);
            cursor: pointer;
            width: 70px;
            height: 70px;
            background: #00b3ff;
            border-radius: 50%;
            text-align: center;
        }

        .player .play-button svg#play {
            margin: 18px 0 0 20px
        }

        .player .play-button svg#pause {
            margin: 18px auto 0
        }

        .player .play-button svg,
        .player .player-controlls .volume svg,
        .player .player-controlls .subtitles svg,
        .player .player-controlls .full-screen svg {
            display: none;
            height: 35px;
            width: 35px;
            fill: #ffffff;
        }

        .player .play-button.play svg#pause,
        .player .player-controlls .volume.unmuted svg#volume,
        .player .player-controlls .full-screen.enter svg#enter-fullscreen {
            display: block;
        }

        .player .play-button.pause svg#play,
        .player .player-controlls .volume.muted svg#muted,
        .player .player-controlls .full-screen.exit svg#exit-fullscreen {
            display: block;
        }

        .player .player-controlls .player-progress-bar {
            flex: 1;
            min-width: 0;
            height: 13px;
            position: relative;
        }

        .player .player-controlls .player-progress-bar .buffered {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            height: 5px;
            position: absolute;
            top: 4px;
            left: 0;
            transition: width 0.2s ease;
        }

        .player .player-controlls .timer {
            padding: 0 15px;
            font-size: 13px;
            color: #ffffff;
        }

        .player .player-controlls .volume-control {
            padding: 0 10px 0 0;
            align-items: center;
            display: flex;
            max-width: 110px;
            min-width: 80px;
            position: relative;
            width: 20%;
            cursor: pointer;
        }

        .player .player-controlls .volume-control .volume svg,
        .player .player-controlls .subtitles svg,
        .player .player-controlls .full-screen svg {
            width: 18px;
            height: 18px;
        }

        .player .player-controlls .volume-control .volume {
            margin-right: 10px
        }

        .player .player-controlls .subtitles,
        .player .player-controlls .full-screen {
            padding: 0 15px 0 5px;
            cursor: pointer;
        }

        .player .player-controlls .subtitles svg {
            display: block;
        }

        input[type=range] {
            -webkit-appearance: none;
            border: 0;
            border-radius: 10px;
            display: block;
            height: 13px;
            margin: 0;
            padding: 0;
            transition: box-shadow .3s ease;
            width: 100%;
            position: relative;
            z-index: 2;
            background-color: transparent;
        }

        input[type=range]::-webkit-slider-runnable-track {
            background: 0 0;
            border: 0;
            border-radius: calc(5px / 2);
            height: 5px;
            transition: box-shadow .3s ease;
            -webkit-user-select: none;
            user-select: none;
            color: #00b3ff;
            background-color: rgba(255, 255, 255, .25);
            background-image: linear-gradient(to right, #00b3ff var(--value, 0), transparent var(--value, 0))
        }

        input[type=range]::-webkit-slider-thumb {
            background: #fff;
            border: 0;
            border-radius: 100%;
            box-shadow: 0 1px 1px rgba(35, 40, 47, .15), 0 0 0 1px rgba(35, 40, 47, .2);
            height: 13px;
            position: relative;
            transition: all .2s ease;
            width: 13px;
            -webkit-appearance: none;
            margin-top: calc(((13px - 5px)/ 2) * -1);
        }

        input[type=range]:focus {
            outline: 0
        }

        input[type=range]:active::-webkit-slider-thumb {
            box-shadow: 0 1px 1px rgba(35, 40, 47, .15), 0 0 0 1px rgba(35, 40, 47, .2), 0 0 0 3px rgba(255, 255, 255, .5);
        }
    </style>
</head>

<body class="active">
    <div id="loader" class="loader flex-cont column full-height">
        <div class="flex-cont column full-height">
            <div class="detail-box">
                <div class="loading-text" id="loading-text">Connecting...</div>
                <div class="progress-bar">
                    <span style="width:0%" id="initial-loading"></span>
                </div>
                <div class="flex-cont space-around">
                    <div class="flexbox" id="dspeed">
                        Down: -
                    </div>
                    <div class="flexbox" id="uspeed">
                        Up: -
                    </div>
                    <div class="flexbox" id="peers">
                        Peer: 0
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="player-container" class="player flex-cont full-height">
        <div class="controlls" id="controlls">
            <div class="heading"></div>
            <div class="play-button pause">
                <svg id="pause" viewBox="0 0 18 18">
                    <path
                        d="M6 1H3c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h3c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1zm6 0c-.6 0-1 .4-1 1v14c0 .6.4 1 1 1h3c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1h-3z">
                    </path>
                </svg>
                <svg id="play" viewBox="0 0 18 18">
                    <path
                        d="M15.562 8.1L3.87.225c-.818-.562-1.87 0-1.87.9v15.75c0 .9 1.052 1.462 1.87.9L15.563 9.9c.584-.45.584-1.35 0-1.8z">
                    </path>
                </svg>
            </div>

            <div class="player-controlls">
                <div class="timer" id="timer-done">00:00</div>
                <div class="player-progress-bar">
                    <input type="range" id="progress" name="vol" min="0" max="100" step="0.01" value="0"
                        style="--value:0%" />
                    <div class="buffered" id="buffered" style="width:0%"></div>
                </div>
                <div class="timer" id="timer-elapsed">-00:00</div>
                <div class="volume-control">
                    <div class="volume unmuted" id="volume-icon">
                        <svg id="muted" viewBox="0 0 18 18">
                            <path
                                d="M12.4 12.5l2.1-2.1 2.1 2.1 1.4-1.4L15.9 9 18 6.9l-1.4-1.4-2.1 2.1-2.1-2.1L11 6.9 13.1 9 11 11.1zM3.786 6.008H.714C.286 6.008 0 6.31 0 6.76v4.512c0 .452.286.752.714.752h3.072l4.071 3.858c.5.3 1.143 0 1.143-.602V2.752c0-.601-.643-.977-1.143-.601L3.786 6.008z">
                            </path>
                        </svg>
                        <svg id="volume" viewBox="0 0 18 18">
                            <path
                                d="M15.6 3.3c-.4-.4-1-.4-1.4 0-.4.4-.4 1 0 1.4C15.4 5.9 16 7.4 16 9c0 1.6-.6 3.1-1.8 4.3-.4.4-.4 1 0 1.4.2.2.5.3.7.3.3 0 .5-.1.7-.3C17.1 13.2 18 11.2 18 9s-.9-4.2-2.4-5.7z">
                            </path>
                            <path
                                d="M11.282 5.282a.909.909 0 000 1.316c.735.735.995 1.458.995 2.402 0 .936-.425 1.917-.995 2.487a.909.909 0 000 1.316c.145.145.636.262 1.018.156a.725.725 0 00.298-.156C13.773 11.733 14.13 10.16 14.13 9c0-.17-.002-.34-.011-.51-.053-.992-.319-2.005-1.522-3.208a.909.909 0 00-1.316 0zm-7.496.726H.714C.286 6.008 0 6.31 0 6.76v4.512c0 .452.286.752.714.752h3.072l4.071 3.858c.5.3 1.143 0 1.143-.602V2.752c0-.601-.643-.977-1.143-.601L3.786 6.008z">
                            </path>
                        </svg>
                    </div>
                    <div class="player-progress-bar">
                        <input type="range" id="volume-bar" name="vol" min="0" max="1" step="0.05" value="1"
                            style="--value:100%" />
                    </div>
                </div>
                <div class="subtitles hide" id="subtitles">
                    <svg id="plyr-captions-on" viewBox="0 0 18 18">
                        <path
                            d="M1 1c-.6 0-1 .4-1 1v11c0 .6.4 1 1 1h4.6l2.7 2.7c.2.2.4.3.7.3.3 0 .5-.1.7-.3l2.7-2.7H17c.6 0 1-.4 1-1V2c0-.6-.4-1-1-1H1zm4.52 10.15c1.99 0 3.01-1.32 3.28-2.41l-1.29-.39c-.19.66-.78 1.45-1.99 1.45-1.14 0-2.2-.83-2.2-2.34 0-1.61 1.12-2.37 2.18-2.37 1.23 0 1.78.75 1.95 1.43l1.3-.41C8.47 4.96 7.46 3.76 5.5 3.76c-1.9 0-3.61 1.44-3.61 3.7 0 2.26 1.65 3.69 3.63 3.69zm7.57 0c1.99 0 3.01-1.32 3.28-2.41l-1.29-.39c-.19.66-.78 1.45-1.99 1.45-1.14 0-2.2-.83-2.2-2.34 0-1.61 1.12-2.37 2.18-2.37 1.23 0 1.78.75 1.95 1.43l1.3-.41c-.28-1.15-1.29-2.35-3.25-2.35-1.9 0-3.61 1.44-3.61 3.7 0 2.26 1.65 3.69 3.63 3.69z"
                            fill-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="full-screen enter">
                    <svg id="enter-fullscreen" viewBox="0 0 18 18">
                        <path d="M10 3h3.6l-4 4L11 8.4l4-4V8h2V1h-7zM7 9.6l-4 4V10H1v7h7v-2H4.4l4-4z"></path>
                    </svg>
                    <svg id="exit-fullscreen" viewBox="0 0 18 18">
                        <path d="M1 12h3.6l-4 4L2 17.4l4-4V17h2v-7H1zM16 .6l-4 4V1h-2v7h7V6h-3.6l4-4z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <video playsinline id="player"></video>
        <div class="loading flex-cont hide" id="buffer-loading">
            <img src="https://souvik1991.github.io/loading.gif" alt="loading" />
            <span>Buffering...</span>
        </div>
    </div>
    <script type="text/javascript">
        (function () {
            var torrent = undefined,
                client = undefined,
                throttle = (func, wait) => {
                    var ctx, args, rtn, timeoutID,
                        last = 0;

                    return function throttled() {
                        ctx = this;
                        args = arguments;
                        var delta = new Date() - last;
                        if (!timeoutID)
                            if (delta >= wait) call();
                            else timeoutID = setTimeout(call, wait - delta);
                        return rtn;
                    };

                    function call() {
                        timeoutID = 0;
                        last = +new Date();
                        rtn = func.apply(ctx, args);
                        ctx = null;
                        args = null;
                    };
                },
                getQueryVar = (varName) => {
                    var queryStr = unescape(window.location.search) + '&',
                        regex = new RegExp('.*?[&\\?]' + varName + '=(.*?)&.*'),
                        val = queryStr.replace(regex, "$1");
                    return val === queryStr ? false : val;
                },
                bytesToSize = (bytes) => {
                    var sizes = ['B', 'Kb', 'Mb', 'Gb', 'Tb'];
                    if (bytes == 0) return '0.0';
                    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
                    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
                }
            updateSpeed = () => {
                var progress = (100 * torrent.progress).toFixed(1);
                // console.log(progress);
                if (!torrent.done) {
                    loadingText.innerText = `Loading... (${(progress)}%)`;
                    initLoading.style.width = `${(progress)}%`;

                    dspeed.innerText = `Down: ${bytesToSize(client.downloadSpeed)}/s`;
                    uspeed.innerText = `Up: ${bytesToSize(client.uploadSpeed)}/s`;
                    peers.innerText = torrent.numPeers > 1 ? `Peers: ${torrent.numPeers}` : `Peer: ${torrent.numPeers}`;
                }
            },
                setHeading = (name) => {
                    var heading = document.querySelectorAll('.heading'),
                        i = 0;
                    for (; i < heading.length; i++)
                        heading[i].innerText = name;
                },
                languageMap = (name) => {
                    var map = {
                        en: 'English',
                        nl: 'Dutch',
                        pt: 'Portuguese',
                        ru: 'Russian',
                        pl: 'Polish'
                    },
                        lang;

                    name = name.split('.');
                    name.pop(0);
                    lang = map[name[name.length - 1]]
                    return lang ? { lang: lang, code: name[name.length - 1] } : undefined;
                },
                processFiles = () => {
                    var tmpObject = {
                        video: [],
                        subtitles: []
                    };
                    torrent.files.forEach((file) => {
                        if (file.name.endsWith('.mp4')) tmpObject.video.push(file);
                        else if (file.name.endsWith('.srt') || file.name.endsWith('.vtt')) {
                            file.getBlobURL((err, url) => {
                                var lang = languageMap(file.name);
                                if (lang) tmpObject.subtitles.push({ lang: lang.lang, code: lang.code, url: url });
                            });
                        }
                    });
                    return tmpObject;
                },
                convertTime = (seconds) => {
                    var hours = Math.floor(seconds / 3600);
                    seconds %= 3600
                    var minutes = Math.floor(seconds / 60);
                    seconds = Math.floor(seconds % 60);

                    if (minutes < 10) minutes = `0${minutes}`;
                    if (seconds < 10) seconds = `0${seconds}`;

                    return hours > 0 ? `${hours}:${minutes}:${seconds}` : `${minutes}:${seconds}`;
                },
                bindEvent = (el, event, fn) => {
                    el.addEventListener ? el.addEventListener(event, fn, false) : el.attachEvent && el.attachEvent('on' + event, fn);
                },
                bindSubtitles = () => {
                    console.log(player);
                },
                getOffset = (el) => {
                    const rect = el.getBoundingClientRect();
                    return {
                        left: rect.left + window.scrollX,
                        top: rect.top + window.scrollY,
                        right: rect.right + window.scrollX,
                        bottom: rect.bottom + window.scrollY,
                        width: rect.width || el.offsetWidth,
                        height: rect.height || el.offsetHeight
                    };
                },
                bindVideo = () => {
                    var controls = {
                        play: document.querySelector('.play-button'),
                        timeDone: document.getElementById('timer-done'),
                        timeRemain: document.getElementById('timer-elapsed'),
                        progress: {
                            bar: document.getElementById('progress'),
                            buffered: document.getElementById('buffered'),
                        },
                        volume: {
                            bar: document.getElementById('volume-bar'),
                            icon: document.getElementById('volume-icon')
                        },
                        fullScreen: document.querySelector('.full-screen')
                    },
                        percentage = 0,
                        setTimeOutId = undefined,
                        videoLoaded = false,
                        volumeValue = 1,
                        isBuffering = false,
                        showControl = false,
                        body = (document.body || document.querySelector('body'));

                    bindEvent(controls.play, 'click', () => {
                        if (player.paused) player.play();
                        else player.pause();
                    });

                    bindEvent(body, 'mousemove', throttle((e) => {
                        if (videoLoaded) {
                            if (!showControl) {
                                showControl = true;
                                body.classList.remove('inactive');
                                body.classList.add('active');
                            }

                            var el = e.target,
                                overControl = false;
                            while (el.tagName !== "BODY") {
                                if (el.classList.contains('player-controlls') || el.classList.contains('play-button')) {
                                    overControl = true;
                                    break;
                                }
                                el = el.parentNode;
                            }

                            if (setTimeOutId) window.clearTimeout(setTimeOutId);
                            if (!overControl) {
                                setTimeOutId = window.setTimeout(() => {
                                    setTimeOutId = undefined;
                                    showControl = false;
                                    body.classList.remove('active');
                                    body.classList.add('inactive');
                                }, 4000);
                            }
                        }
                    }, 500));

                    bindEvent(controls.fullScreen, 'click', () => {
                        if (controls.fullScreen.classList.contains('enter')) {
                            if (player.requestFullscreen) player.requestFullscreen()
                            else if (player.mozRequestFullScreen) player.mozRequestFullScreen();
                            else if (player.webkitRequestFullscreen) player.webkitRequestFullscreen();
                            else if (player.msRequestFullscreen) player.msRequestFullscreen();

                            controls.fullScreen.classList.remove('enter');
                            controls.fullScreen.classList.add('exit');
                        }
                        else {
                            if (document.exitFullscreen) document.exitFullscreen();
                            else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
                            else if (document.webkitExitFullscreen) document.webkitExitFullscreen();
                            else if (document.msExitFullscreen) document.msExitFullscreen();

                            controls.fullScreen.classList.remove('exit');
                            controls.fullScreen.classList.add('enter');
                        }
                    });

                    bindEvent(controls.volume.icon, 'click', () => {
                        if (controls.volume.icon.classList.contains('unmuted')) {
                            controls.volume.icon.classList.remove('unmuted');
                            controls.volume.icon.classList.add('muted');
                            player.volume = 0;
                            controls.volume.bar.value = 0;
                            controls.volume.bar.style.setProperty('--value', 0);
                        }
                        else {
                            controls.volume.icon.classList.remove('muted');
                            controls.volume.icon.classList.add('unmuted');
                            player.volume = volumeValue;

                            controls.volume.bar.value = volumeValue;
                            controls.volume.bar.style.setProperty('--value', `${volumeValue * 100}%`);
                        }
                    });

                    bindEvent(controls.volume.bar, 'input', () => {
                        volumeValue = controls.volume.bar.value;
                        controls.volume.bar.style.setProperty('--value', `${volumeValue * 100}%`);
                        player.volume = volumeValue;

                        if (parseFloat(volumeValue) === 0) {
                            controls.volume.icon.classList.remove('unmuted');
                            controls.volume.icon.classList.add('muted');
                        }
                        else if (controls.volume.icon.classList.contains('muted')) {
                            controls.volume.icon.classList.remove('muted');
                            controls.volume.icon.classList.add('unmuted');
                        }
                    })

                    player.onplay = () => {
                        controls.play.classList.remove('pause');
                        controls.play.classList.add('play');
                    };
                    player.onpause = () => {
                        controls.play.classList.remove('play');
                        controls.play.classList.add('pause');

                        if (setTimeOutId !== undefined) window.clearTimeout(setTimeOutId);
                    };
                    player.onplaying = () => {
                        isBuffering = false;
                        bufferLoading.classList.add('hide');
                        if (setTimeOutId !== undefined) window.clearTimeout(setTimeOutId);
                        setTimeOutId = window.setTimeout(() => {
                            setTimeOutId = undefined
                            body.classList.remove('active');
                            body.classList.add('inactive');
                        }, 4000);
                    };
                    player.oncanplay = () => {
                        loader.classList.add('float');
                        bufferLoading.classList.add('hide');
                        videoLoaded = true;
                    };
                    player.onloadedmetadata = () => {
                        bufferLoading.classList.add('hide');
                        controls.timeDone.innerText = convertTime(player.currentTime);
                        controls.timeRemain.innerText = `-${convertTime(player.duration)}`;

                        if (!videoLoaded) {
                            loader.classList.add('float');
                            bufferLoading.classList.add('hide');
                            videoLoaded = true;
                        }
                    };
                    player.onprogress = throttle(() => {
                        if (player.buffered.length > 0) controls.progress.buffered.style.width = `${(player.buffered.end(0) / player.duration) * 100}%`;
                    }, 800);
                    player.ontimeupdate = throttle(() => {
                        controls.timeDone.innerText = convertTime(player.currentTime);
                        controls.timeRemain.innerText = `-${convertTime(player.duration - player.currentTime)}`;
                        percentage = (player.currentTime / player.duration) * 100;
                        controls.progress.bar.value = percentage;
                        controls.progress.bar.style.setProperty('--value', `${percentage}%`);
                    }, 800);
                    player.onwaiting = function () {
                        isBuffering = true;
                        bufferLoading.classList.remove('hide');
                    }
                },
                onTorrent = (tr) => {
                    torrent = tr;
                    if (torrent.name) setHeading(torrent.name);

                    updateSpeed();
                    torrent.on('download', throttle(updateSpeed, 500));
                    torrent.on('upload', throttle(updateSpeed, 500));

                    var files = processFiles();
                    if (files.video.length > 0) {
                        files.video[0].renderTo('#player', {
                            autoplay: false,
                            muted: false,
                            controls: false,
                        }, (err, elm) => {
                            console.log(files.subtitles);
                            if (files.subtitles && files.subtitles.length > 0) {
                                var i = 0,
                                    track;

                                for (; i < files.subtitles.length; i++) {
                                    track = document.createElement('track');
                                    track.setAttribute('label', files.subtitles[i].lang);
                                    track.setAttribute('kind', 'subtitles');
                                    track.setAttribute('srclang', files.subtitles[i].code);
                                    track.setAttribute('src', files.subtitles[i].url);
                                    if (i == 0) track.setAttribute('default', true);
                                    player.appendChild(track);
                                }
                                bindSubtitles();
                            }
                        });
                        bindVideo();
                    }
                },
                tid = getQueryVar('tid'), //'08ada5a7a6183aae1e09d831df6748d566095a10',
                poster = getQueryVar('poster'),
                dn = getQueryVar('dn'),
                magnet = getQueryVar('magnet'),
                loader = document.getElementById('loader'),
                player = document.getElementById('player'),
                controlls = document.getElementById('controlls'),
                container = document.getElementById('player-container'),
                initLoading = document.getElementById('initial-loading'),
                loadingText = document.getElementById('loading-text'),
                bufferLoading = document.getElementById('buffer-loading'),
                dspeed = document.getElementById('dspeed'),
                uspeed = document.getElementById('uspeed'),
                peers = document.getElementById('peers');

            if (poster) {
                // loader.style.backgroundImage = `url(${poster})`;
                player.setAttribute('poster', poster);
            }

            if (tid || magnet) {
                // WebTorrent.WEBRTC_SUPPORT = false;
                client = new WebTorrent();
                var trackers = [
                    // 'udp://explodie.org:6969',
                    // 'udp://tracker.empire-js.us:1337',
                    // 'wss://tracker.btorrent.xyz',
                    // 'wss://tracker.sloppyta.co:443/announce',
                    // 'wss://tracker.openwebtorrent.com',
                    // 'udp://glotorrents.pw:6969/announce',
                    // 'udp://tracker.opentrackr.org:1337/announce',
                    // 'udp://torrent.gresille.org:80/announce',
                    // 'udp://tracker.openbittorrent.com:80',
                    // 'udp://tracker.coppersurfer.tk:6969',
                    // 'udp://tracker.leechers-paradise.org:6969',
                    // 'udp://p4p.arenabg.ch:1337',
                    // 'udp://tracker.internetwarriors.net:1337',
                    // 'udp://open.demonii.com:1337/announce',
                    // 'udp://public.popcorn-tracker.org:6969/announce',
                    // 'http://mgtracker.org:2710/announce',
                    'http://tracker.trackerfix.com:80/announce',
                    'udp://9.rarbg.me:2720/announce',
                    'udp://9.rarbg.to:2900/announce',
                    'udp://tracker.thinelephant.org:12710/announce',
                    'udp://tracker.slowcheetah.org:14780/announce',
                    'udp://tracker.zer0day.to:1337/announce',
                    'udp://tracker.leechers-paradise.org:6969/announce',
                    'udp://coppersurfer.tk:6969/announce'
                ],
                    magnetLink = <? echo $_POST["magnet"] || 'magnet:?xt=urn:btih:477C83C6981D5F025EF91143C7C0A5622DB29823&dn=Uncharted.2022.1080p.WEBRip.x265&tr=http%3A%2F%2Ftracker.trackerfix.com%3A80%2Fannounce&tr=udp%3A%2F%2F9.rarbg.me%3A2830%2Fannounce&tr=udp%3A%2F%2F9.rarbg.to%3A2970%2Fannounce&tr=udp%3A%2F%2Ftracker.slowcheetah.org%3A14710%2Fannounce&tr=udp%3A%2F%2Ftracker.tallpenguin.org%3A15730%2Fannounce&tr=udp%3A%2F%2Ftracker.opentrackr.org%3A1337%2Fannounce&tr=http%3A%2F%2Ftracker.openbittorrent.com%3A80%2Fannounce&tr=udp%3A%2F%2Fopentracker.i2p.rocks%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.internetwarriors.net%3A1337%2Fannounce&tr=udp%3A%2F%2Ftracker.leechers-paradise.org%3A6969%2Fannounce&tr=udp%3A%2F%2Fcoppersurfer.tk%3A6969%2Fannounce&tr=udp%3A%2F%2Ftracker.zer0day.to%3A1337%2Fannounce'; ?>;
                client.add(magnetLink, onTorrent);
                // bindVideo()
            }
            else alert('Torrent id is not passed.')
        })();
    </script>
</body>

</html>