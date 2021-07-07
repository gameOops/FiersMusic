<template>
    <div style="padding-top: 60px;">
        <input class="search_inp" @input="search" v-model="searcher" type="text" id="searcher" placeholder="Исполнитель, трек или альбом">

        <div class="album_tracks">
            <h4 class="row_title" style="color: white;">Треки</h4>
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
        <div class="music_row" style="margin-left: 25px;">
            <h4 class="row_title">Альбомы исполнителя</h4>

            <div class="row_cont" v-if="albumAll">
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
            <div v-else>
                <i class="bi bi-clock"></i>
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
                current:this.$router.currentRoute,
                tracks:[],
                searcher:'',
                albumAll:[]
            }
        },
        methods: {
            search() {
                if(this.searcher) {
                    let data = {
                        'query': this.searcher
                    };
                    axios.post('/api/searchTrack', data)
                        .then(({data}) => {
                            console.log(data)
                            this.tracks = data;
                        })
                    axios.post('/api/searchAlbum', data)
                        .then(({data}) => {
                            console.log(data)
                            this.albumAll = data;
                        })
                }
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

        }
    }
</script>
