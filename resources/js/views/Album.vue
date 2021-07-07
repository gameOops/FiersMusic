<template>
    <div style="    padding-top: 35px;">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавление трека</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Название трека</label>
                            <input type="email" v-model="name" class="form-control" placeholder="Введите название трека">
                        </div>
                        <div class="mb-3">
                            <label  class="form-label">Автор
                            </label>
                            <input type="text" v-model="author" class="form-control" placeholder="Введите автора">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Трек
                            </label>
                            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Согласен с условиями использования Spotify</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отменить</button>
                        <button type="button" class="btn btn-primary" @click="create">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="album_header">
            <div class="album_img">
                <img :src="album.image" alt="">
            </div>
            <div class="album_info">
                <div class="stat">
                    Альбом
                </div>
                <div class="album_name">
                    {{album.name}}
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bi bi-plus-circle"></i>
                    </button>

                </div>
                <div class="album_author">
                    <router-link :to="{ name: 'artist',params: { id: album.author }}">
                        {{album.author}}
                    </router-link>

                </div>
            </div>

        </div>


        <div class="album_tracks">
            <table class="table table-borderless">
                <thead style="border-bottom: 1px solid;    color: #b3b3b3;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Last</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="(item,key) in album.tracks" :id="'tr_'+(key+1)" @mouseover="showPlay(key)" @mouseleave="hidePlay(key)" @click="play(item.src,item.name,item.author,key+1)">
                    <th scope="row" style="width: 40px">
                        <p :id="'track_'+(key+1)" style="margin-bottom: 0px;">{{key+1}}</p>
                        <i :id="'play_'+(key+1)" style="display: none" class="bi bi-play-fill"></i>
                        <img :id="'playing_'+(key+1)" src="https://open.scdn.co/cdn/images/equaliser-animated-green.73b73928.gif" style="width: 14px;height: 14px;display: none">
                    </th>
                    <td style="width: 88%;font-weight: bold;">{{item.name}}<br><p style="color: #b3b3b3;margin-bottom: 0px;">{{item.author}}</p></td>
                    <td>1:12</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div style="color: rgb(179, 179, 179);    font-size: 11px;
    font-weight: 400;    padding-left: 25px;
    padding-top: 15px;">
            © {{year}} {{author}}
        </div>
        <div style="color: rgb(179, 179, 179);    font-size: 11px;
    font-weight: 400;    padding-left: 25px;
    padding-top: 1px;">
            ℗ {{year}} {{author}}
        </div>
        <div class="music_row">
            <h4 class="row_title">{{author}}: другие альбомы</h4>
            <div class="row_cont">
                <div class="music_card" v-for="item in albumAll">
                    <router-link :to="{ name: 'album',params: { id: item.id }}">
                        <div class="card_img">
                            <img :src="item.image" alt="">
                            <button class="card_play" aria-label="Слушать"><i class="bi bi-play-fill" style=""></i></button>
                        </div>
                        <div class="card_title">
                            {{item.name}}
                        </div>
                        <div class="card_author">
                            {{item.author}}
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Album",

        data() {
            return {
                id:this.$route.params.id,
                album: [],
                albName:'',
                allPrice:0,
                albumAll:[],
                author:'',
                file: '',
                name:'',
                year:'',
                idAlbum:'',
                playing:'',
                prevPlaying:''
            }
        },
        methods: {
            loadPlaylist() {
                let data = {
                    'id':this.id
                };
                axios.post('/api/playlist',data)
                    .then(({data}) => {
                        this.album = data[0];
                        songs = data[0]['tracks'];
                        this.author = data[0]['author']
                        this.year = data[0]['year']
                        this.albName = data[0]['name']
                        this.idAlbum = data[0]['id']
                        let album_name = document.querySelector('.album_name');
                        document.addEventListener('scroll', function (event) {
                            if(Visible(album_name) == 'false') {
                                $('.min_name').text(data[0]['name']);
                                console.log(data[0]['name'])
                            } else {
                                $('.min_name').text('');
                            }
                        }, true);
                        let data2 = {
                            'artist':data[0]['author']
                        };
                        axios.post('/api/selectAll',data2)
                            .then(({data}) => {
                                console.log(data);
                                this.albumAll = data;
                            })
                        document.title = 'Spotify — ' +this.album.name;

                    })
            },
            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },
            create() {
                let data = new FormData;
                data.append('track',this.$refs.file.files[0]);
                data.append('name',this.name);
                data.append('author',this.author);
                data.append('year',this.year);
                data.append('id',this.idAlbum);

                axios.post('/api/addNewTrack',data)
                    .then(({data}) => {

                    })
            },
            getAll() {

            },
            showPlay(id) {
                if((this.playing - 1) != id) {
                    $('#track_'+(id+1)).hide();
                    $('#play_'+(id+1)).show();
                }
            },
            hidePlay(id) {
                if((this.playing - 1) != id) {
                    $('#track_' + (id + 1)).show();
                    $('#play_' + (id + 1)).hide();
                }
            },
            play(src,name,author,id) {
                $('#audioplayer').attr('src','/audio/'+src);
                $('#audioplayer').trigger("play");
                $('#play_btn').removeAttr('class');
                $('#play_btn').attr('class','bi bi-pause-circle-fill')
                isPlay = 1;
                $('#cur_img').attr('src',this.album.image);
                $('#audio_line').attr('max',document.getElementById('audioplayer').duration);
                $('#audio_line').val(0)
                $('#cur_name').text(name);
                $('#cur_auth').text(author);
                $('#track_'+id).hide();
                $('#play_'+id).hide();
                this.prevPlaying = this.playing;
                this.playing = id;
                $('#playing_'+this.prevPlaying).hide();
                $('#playing_'+id).show();
                $('#tr_'+this.prevPlaying).css('background-color','#28282800');
                $('#tr_'+id).css('background-color','#282828');
            }
        },
        created() {
            setTimeout(function() {
                let album_name = document.querySelector('.album_name');
                document.addEventListener('scroll', function (event) {
                    if(Visible(album_name) == 'false') {
                        $('.min_name').text(this.name);
                        console.log(this.albName)
                    }
                }, true);
            },2000)


        },
        mounted() {
            this.loadPlaylist();
            this.getAll();
        }
    }
</script>

<style scoped>

</style>
