<template> 
    <div class="container media">
        <div class="media__library">

            <LightBox @clicked="onClickChild"
            :items="lightbox.items"
            :thumbnails="lightbox.images.thumbnails"
            :largeImages="lightbox.images.largeImages"
            :edit="lightbox.edit"
            />
           
        </div> 

        <div class="media__edit">
            <Edit
            :title="title"
            :description="description"
            :id="id"
            />  
        </div>

    </div>
   
</template>

<script>
import axios from 'axios'
import Edit from '../components/Edit.vue'
import LightBox from '../components/LightBox.vue'
export default {
    components: {
        Edit,
        LightBox
    },

    data(){
        return {
           title:"",
           description: "",
           id:"",
           lightbox: {
                items:[],
                images: {
                    thumbnails: [],
                    largeImages: [],
                }, 
                edit: true
           }
        }
    },
    methods: {
        allImageDetails(){
            axios.get('/api/all')
            .then((res) => {
                //console.log(res)
                this.lightbox.items = res.data
                this.lightbox.images.thumbnails=[]
                res.data.forEach(e => {
                    console.log("e", e)
                        this.lightbox.images.thumbnails.push(e.image_path)
                        this.lightbox.images.largeImages.push(e.large_image_path)
                });
            })
        },

        singleImage(id){
            axios.get('/api/all/' + id)
            .then((res) => {
                this.title = res.data.title
                this.description = res.data.description
                this.id = id
            })
        },

        onClickChild (id) {
            this.singleImage(id)
            console.log(id)
        },
        
    },
    mounted(){
        this.allImageDetails()
    }
}

</script>

<style lang="scss">
.media {
   display: flex;
   justify-content: space-around;

   &__library {
    width: 60%;
    text-align: center;
   }

   &__edit {
    width: 40%;
    margin-right: 5%;
    margin-top: 20px
   }
}
</style>