<template>
    <div class="container my-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Download Video</div>
                    <div class="card-body">
                        <div class="justify-content-center d-flex">
<!--                            <button class="btn btn-danger" @click="video = 'youtube'">-->
<!--                                <i class="fa-brands fa-youtube"></i>-->
<!--                                Video Youtube-->
<!--                            </button>-->
                            <button class="btn btn-dark mx-3" @click="video = 'tiktok'">
                                <i class="fa-brands fa-tiktok"></i>
                                Video TikTok
                            </button>
                        </div>
                        <div id="form-youtube" class="my-3">

                            <div class="row align-items-center">
                                <div class="col-md-8 col-lg-8 col-xl-8 col-sm-12">
                                    <label for="video-youtube-url">Đường dẫn video youtube</label>
                                    <input class="form-control" @change="onChangeUrl" v-model="videoOptions.url" :class="{ errorMessages: 'is-inValid' }" placeholder="https://www.youtube.com/watch?v=VDxQP_88eBY&list=RDVDxQP_88eBY&start_radio=1" type="text">
                                </div>
                                <div class="col-md-2">
                                    <label for="quality">Chất lượng</label>
                                    <select class="form-control" v-model="videoOptions.quality" id="quality">
                                        <option value="mp4">Mp4</option>
                                        <option value="mp3">Mp3</option>
                                    </select>
                                </div>
                                <div class="spinner-border text-success d-flex align-self-end" role="status" v-if="isLoading">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <div class="col-md-2 d-flex align-self-end" v-else>
                                    <button @click="downloadVideo" class="btn btn-primary btn-block">Tải xuống</button>
                                </div>

                                <p style="color: red">
                                    {{ errorMessages }}
                                </p>
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
            videoOptions: {
                url: null,
                quality: "mp4",
            },
            video: 'tiktok',
            errorMessages: '',
        }
    },
    methods: {
        downloadVideo() {
            if (!this.videoOptions.url) {
                this.errorMessages = 'Vui lòng nhập đường dẫn video';
                console.log(this.errorMessages);
                return;
            }
            this.isLoading = true;
            axios.post('/api/download-video', {
                url: this.videoOptions.url,
                quality: this.videoOptions.quality,
                type: this.video,
            }).then((response) => {
                console.log(response.data);
                const video = response.data

                if(this.videoOptions.quality === 'mp3') {
                    this.fetchFileAndDownload(video.music, video.description + '.mp3');
                }else {
                    this.fetchFileAndDownload(video.video, video.description + '.mp4');
                }
                this.isLoading = false;
                this.errorMessages = '';
            }).catch((error) => {
                this.errorMessages = error.response.data.error;
                console.log(error);
                this.isLoading = false;
            });
        },
        fetchFileAndDownload(url, name) {
            fetch(url) // Call the fetch function passing the url of the API as a parameter
                .then((resp) => resp.blob()) // Transform the data into blob
                .then(function (blob) {
                    // Create blob link to download
                    let url = window.URL.createObjectURL(blob);
                    let a = document.createElement('a');
                    a.href = url
                    a.download = name;
                    a.click();
                })
                .catch(function (error) {
                    // If there is any error you will catch them here
                    console.log(error);
                    this.errorMessages = 'Có lỗi xảy ra vui lòng thu lại sau vài phút'
                });
        },
        onChangeUrl() {
            if(this.videoOptions.url) {
                this.errorMessages = '';
            }else {
                this.errorMessages = 'Vui lòng nhập đường dẫn video';
            }
        }
    }

}
</script>

<style scoped>

</style>
