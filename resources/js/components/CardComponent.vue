<template>
    <div class="col-md-4">
        <div class="card mb-4 shadow-sm">
            <!-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> -->
    
            <div class="card-body">
                <p class="card-text">Tirada de dados.</p>
                <p class="card-text">User id:{{roll.user_id}}</p>
                <p class="card-text">Dado 1 :{{roll.value1}}</p>
                <p class="card-text">Dado 2 :{{roll.value2}}</p>
               
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <button type="button" v-on:click="deleteRoll" class="btn btn-danger btn-sm ">Delete</button>
                      
                    </div>
                    <small class="text-muted"> {{roll.id}} </small>
                   
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    props:{
        roll: {
            type: Object,
            required: true
        }
    },
    data(){
        return {
          
        }
    },
    methods:{
        deleteRoll(){
            //console.log(this.roll);
            // axios.delete('api/rolls/'+ this.roll.id).then(() => {               
            //     this.$emit('delete');
            // });

            axios.get('api/rolls/'+ this.roll.id).then(() => {               
                this.$emit('delete');
            });
           
        }
    }
    
}

</script>

