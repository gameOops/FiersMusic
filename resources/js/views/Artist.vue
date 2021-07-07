<template>
    <div>
        <div class="artist_bg">
            <div class="artist_info">
                <div class="verify">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 21.6596l-3.38079 1.8543-1.84158-3.3877-3.84662-.2679.28231-3.8456-3.09118-2.3049 2.31658-3.0825-1.3543-3.61028 3.61534-1.34071.81255-3.76935 3.76627.82672L12 0l2.7214 2.73168 3.7663-.82672.8125 3.76935 3.6154 1.34071-1.3543 3.61028 2.3166 3.0825-3.0912 2.3049.2823 3.8456-3.8466.2679-1.8416 3.3877L12 21.6596z" fill="#2E77D0"></path><path d="M16.8637 7.41226l-6.6435 7.77824-2.80421-3.2842-.4935.5775 3.29771 3.8617 7.2135-8.44649-.57-.48675z" fill="#fff"></path></svg>
                    <p>Подтвержденный артист</p>
                </div>
                <div class="artist_name">
                    {{artist['name']}}
                </div>
                <div class="listens">
                    2 740 784 слушателей за месяц
                </div>
            </div>

        </div>
        <div class="album_tracks">
            <h4 class="row_title" style="color: white;">Популярные треки</h4>
            <table class="table table-borderless">
                <tbody>
                <tr v-for="(item,key) in tracks" @mouseover="showPlay(key)" @mouseleave="hidePlay(key)" @click="play(item.src,item.name,item.author,item['playlist']['image'])">
                    <th scope="row" style="width: 40px"><p :id="'track_'+(key+1)" style="margin-bottom: 0px;">{{key+1}}</p><i :id="'play_'+(key+1)" style="display: none" class="bi bi-play-fill"></i></th>
                    <td><img style="width: 40px; height: 40px;" :src="item['playlist']['image']" alt=""></td>
                    <td style="width: 88%;font-weight: bold;">{{item.name}}<br><p style="color: #b3b3b3;margin-bottom: 0px;">{{item.author}}</p></td>
                    <td>1:12</td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="artist_content">
            <div class="music_row">
                <h4 class="row_title">Альбомы исполнителя</h4>
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
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        name: "Album",

        data() {
            return {
                id:this.$route.params.id,
                name:'',
                albumAll:[],
                artist:[],
                tracks:[]
            }
        },
        methods: {
            loadArtist() {
                let data = {
                    'name': this.id
                };
                axios.post('/api/selectArtist', data)
                    .then(({data}) => {
                        console.log(data);
                        this.artist = data;
                        this.name = data['name']
                        $('.artist_bg').css('background','url("'+data['image']+'") fixed');
                        let data2 = {
                            'artist':data['name']
                        };
                        axios.post('/api/selectAll',data2)
                            .then(({data}) => {
                                console.log(data);
                                this.albumAll = data;
                            })
                        let data3 = {
                            'name':data['name']
                        };
                        axios.post('/api/selectTracks',data3)
                            .then(({data}) => {
                                console.log(data);
                                this.tracks = data;
                            })
                    })

            },
            showPlay(id) {
                $('#track_'+(id+1)).hide();
                $('#play_'+(id+1)).show();
            },
            hidePlay(id) {
                $('#track_'+(id+1)).show();
                $('#play_'+(id+1)).hide();
            },
            play(src,name,author,img) {
                $('#cur_name').text(name);
                $('#cur_auth').text(author);
                $('#audioplayer').attr('src','/audio/'+src);
                $('#audioplayer').trigger("play");
                $('#play_btn').removeAttr('class');
                $('#play_btn').attr('class','bi bi-pause-circle-fill')
                isPlay = 1;
                $('#cur_img').attr('src',img);
                $('#audio_line').attr('max',document.getElementById('audioplayer').duration);
                $('#audio_line').val(0)

            }
        },
        mounted() {
            this.loadArtist();
        }
    }
</script>
