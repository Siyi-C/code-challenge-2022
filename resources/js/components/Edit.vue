<template>
    <label for="title">Title</label>
    <input type="text" v-model="title"/>

    <label for="desc">Description</label>
    <textarea rows = "5" cols = "60" name = "description" v-model="description">
    </textarea>

    <div class="btns">
        <div class="edit-btn" @click="edit(this.id)"><p>Save</p></div>
        <div class="delete-btn" @click="deleted(this.id)"><p>Delete</p></div>
    </div>
   

    <!-- <div class="edit-btn" @click="edit"><p>Edit</p></div> -->
</template>

<script>
import axios from 'axios'
export default {
    data(){
        return {

        }
    },
    props: {
        title:{
            type: String,
            required: true
        },
        description:{
            type: String,
            required: true
        },
        id:{
            type: String,
            required: true
        }
    },

    methods: {
        edit(id) {
            axios.put('/api/update/' + id, { 
                title: this.title,
                description: this.description
            }).then(alert("Updated"));
        },

        deleted(id) {
            if(confirm('Are you sure you want to delete this image from Media Library?')) {
                axios.delete('/api/delete/' + id, {}).then()
                // this.$emit('eventname', [])
                location.reload();
            }
           
        }
        // edit() {
        //     axios.put('/api/update/' + id)
        //     .then(res => {
        //         if(res === 200){
        //             console.log(updated)
        //         }else{
        //             console.log(res)
        //         }
        //     })
        // }
    }
}

</script>
