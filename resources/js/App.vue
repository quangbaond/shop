<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Download Video</div>
                    <div class="card-body">
                        <div class="justify-content-center d-flex">
                            <div class="mx-3 p-2"  :class="[video === 'tiktok' ? 'bg-dark' : '']">
                                <button class="btn btn-primary " @click="changeType('tiktok')">
                                    <i class="fa-brands fa-tiktok"></i>
                                    Video TikTok
                                </button>
                            </div>
                            <div class="p-2" :class="[video === 'youtube' ? 'bg-dark' : '']">
                                <button class="btn btn-danger" @click="changeType('youtube')">
                                    <i class="fa-brands fa-youtube"></i>
                                    Video Youtube
                                </button>
                            </div>
                        </div>
                        <div id="form-video" class="my-3">
                            <div class="row align-items-center">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                    <label for="video-url">Đường dẫn video</label>
                                    <input class="form-control" @paste="onPasteUrl" id="video-url" @change="onChangeUrl" v-model="videoOptions.url" :class="{ errorMessages: 'is-inValid' }" :placeholder="placeholder" type="text">
                                </div>
                                <div class="col-md-2" v-if="isEnableQuality">
                                    <label for="quality">Chất lượng</label>
                                    <select class="form-control" v-model="videoOptions.quality" id="quality">
                                        <option v-for="option in videoOptions.qualityOptions" :value="option.value">{{ option.text}}</option>
                                    </select>
                                </div>
                                <div class="spinner-border text-success d-flex align-self-end mt-2 mt-lg-0 mt-md-0" role="status" v-if="isLoading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="d-flex align-self-end mt-2 mt-lg-0 mt-md-0" :class="[isEnableQuality ? 'col-md-2' : 'col-md-4']" v-else>
                                    <button @click="downloadVideo" :disabled="disableBtn" class="btn btn-primary btn-block">{{ btnText }}</button>
                                </div>

                                <p style="color: red">
                                    {{ errorMessages }}
                                </p>
                            </div>
                        </div>
                        <div class="data-youtube" v-if="isLoadedYoutube">
                            <div class="row">
                                <div class="col-md-4">
                                    <img :src="youtubeData.thumbnail" :alt="youtubeData.description" class="img-fluid img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <h3>{{ youtubeData.title }}</h3>
                                    <div v-html="youtubeData.description"></div>
                                    <div class="col-md-4">
                                        <label for="quality">Chọn Chất lượng</label>
                                        <select class="form-control" v-model="youtubeData.quality" id="quality">
                                            <option v-for="option in youtubeData.qualityOptions" :value="option.value">{{ option.text }}</option>
                                        </select>
                                        <button class="btn btn-primary my-2 w-100 " @click="downloadYoutubeVideo">Tải xuống</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    name: "App",
    data() {
        return {
            isLoading :false,
            isEnableQuality: true,
            isLoadedYoutube: false,
            disableBtn: true,
            videoOptions: {
                url: null,
                quality: "mp4",
                qualityOptions: [
                    { value: 'mp4', text: 'Mp4' },
                    { value: 'mp3', text: 'Mp3' },
                ]
            },
            youtubeData: {
                qualityOptions : [
                    { value: 'mp4', text: 'Mp4', url: '' },
                    { value: 'mp3', text: 'Mp3', url: '' },
                ],
                quality: 'mp4',
                title: '',
                thumbnail: [],
                description: '',
            },
            video: 'tiktok',
            errorMessages: '',
            placeholder: 'https://www.tiktok.com/@theanh28entertainment/video/7207820522107833602',
            btnText: 'Tải xuống',
        }
    },
    methods: {
        validateUrl(type, url) {
            if (type === 'tiktok') {
                const regex = /^(http(s)?:\/\/)?((w){3}.)?tiktok.com\/.+/;
                return regex.test(url);
            } else if (type === 'youtube') {
                const regex = /^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/;
                return regex.test(url);
            } else {
                return false;
            }
        },
        onPasteUrl(e) {
            const url = e.clipboardData.getData('text');
            const isValid = this.validateUrl(this.video, url);
            if (!isValid) {
                this.errorMessages = 'Đường dẫn không hợp lệ';
                this.disableBtn = true;
            } else {
                this.errorMessages = '';
                this.disableBtn = false;
            }
        },
        onChangeUrl() {
            if(this.videoOptions.url) {
                const isValid = this.validateUrl(this.video, this.videoOptions.url);
                if (!isValid) {
                    this.disableBtn = true;
                } else {
                    this.errorMessages = '';
                    this.disableBtn = false;
                }
            }else {
                this.errorMessages = 'Vui lòng nhập đường dẫn video';
                this.disableBtn = true;
            }
        },
        getIdFromUrl(url) {
            const regex = /^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/(watch\?v=)?/;
            return url.replace(regex, '');
        },
        changeType(type = 'tiktok'){
            this.videoOptions.url = '';
            if (type === 'tiktok') {
                this.video = 'tiktok';
                this.placeholder = 'https://www.tiktok.com/@theanh28entertainment/video/7207820522107833602';
                this.btnText = 'Tải xuống'
                this.isEnableQuality = true;
                this.isLoadedYoutube = false;
            } else {
                this.btnText = 'Lấy dữ liệu video'
                this.isEnableQuality = false;
                this.video = 'youtube';
                this.placeholder = 'https://www.youtube.com/watch?v=QH2-TGUlwu4';
            }
        },
        downloadVideo() {
            if (!this.videoOptions.url) {
                this.errorMessages = 'Vui lòng nhập đường dẫn video';
                console.log(this.errorMessages);
                return;
            }
            this.isLoading = true;
            axios.post('/api/download-video', {
                url: this.videoOptions.url,
                videoId: this.video === 'youtube' ? this.getIdFromUrl(this.videoOptions.url) : undefined,
                quality: this.videoOptions.quality,
                type: this.video,
            }).then((response) => {
                const videoData = response.data
                if(this.video === 'tiktok') {
                    if(this.videoOptions.quality === 'mp3') {
                        this.fetchFileAndDownload(videoData.music, videoData.description + '.mp3');
                    } else {
                        this.fetchFileAndDownload(videoData.video, videoData.description + '.mp4');
                    }
                } else {
                    this.processResponseYoutube(videoData);
                    this.isLoadedYoutube = true
                }
                this.isLoading = false;
                this.errorMessages = '';
            }).catch((error) => {
                // this.errorMessages = error.response.data.error;
                this.isLoading = false;
            });
        },
        fetchFileAndDownload(url, name) {
            fetch(url, {
                method: 'GET',
                mode: 'no-cors',
                // fix cors error
                headers: {
                    'Access-Control-Allow-Origin': '*',
                },
            }) // Call the fetch function passing the url of the API as a parameter
                .then((resp) => {
                    console.log(resp);
                    return resp.blob();
                }) // Transform the data into blob
                .then(function (blob) {
                    // Create blob link to download

                    console.log(blob)
                    // Create blob link to download
                    let url = window.URL.createObjectURL(blob);
                    let a = document.createElement('a');
                    a.href = url
                    a.download = name;
                    // a.click();
                })
                .catch(function (error) {
                    // If there is any error you will catch them here
                    console.log(error);
                    this.errorMessages = 'Có lỗi xảy ra vui lòng thu lại sau vài phút'
                });
        },
        processResponseYoutube(dataVideo = []) {
            console.log(dataVideo)
            let options = [];
            let links = dataVideo.link;

           // loop objects links
            for (let key in links) {
                for (let i = 0; i < links[key].length; i++) {
                    console.log(links[key])
                    options.push({
                        value: links[key][3],
                        text: `${links[key][3]} (${links[key][2]})`,
                        url: links[key][0],
                    });
                }
            }


            this.youtubeData.qualityOptions = options;
            this.youtubeData.quality = options[0].value;
            this.youtubeData.title = dataVideo.title;
            this.youtubeData.thumbnail = dataVideo.thumb;
            this.youtubeData.description = dataVideo.description ? this.limitText(dataVideo.description, 100) : '';
        },
        limitText(text, limit = 100) {
            if (text.length > limit) {
                return text.substring(0, limit) + '...';
            }
            return text;
        },
        async downloadYoutubeVideo() {
            if (!this.youtubeData.quality) {
                this.errorMessages = 'Vui lòng chọn chất lượng video';
                return;
            }
            const videoSelect = this.youtubeData.qualityOptions.find((item) => item.value === this.youtubeData.quality);
            const filename = this.youtubeData.title + '.' + videoSelect.value;
            // create a link to download
            const link = document.createElement('a');
            link.href = videoSelect.url;
            link.download = filename;
            link.click();
        },
    },

}
</script>

<style scoped>

</style>
