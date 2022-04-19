<template>
    <form  v-on:submit.prevent="newRoll()">
        <div class="form-group">
            <label for="user_id">user_id</label>
            <input type="number" class="form-control" id="user_id" v-model="roll.user_id">
                    
        </div>
        <div class="form-group">
            <label for="value1">value1</label>
            <input type="number" class="form-control" id="value1" v-model="roll.value1">
        </div>
        <div class="form-group">
            <label for="value2">value2</label>
            <input type="number" class="form-control" id="value2" v-model="roll.value2">
        </div>
        
                    
        <button type="submit" class="btn btn-primary my-4">Submit</button>
    </form>

</template>

<script>

let defaultRoll =  {
                
                user_id:'',
                value1:'',
                value2:''
            }


export default {
    data(){
        return {
            roll: Object.assign({},defaultRoll)
        }

    },
    methods:{
        newRoll() {
            axios.post('api/rolls',this.roll).then((response) => {
                //console.log(response)
                //this.$emit('add',this.roll);
                this.$emit('add',response.data.roll);
                this.roll = Object.assign({},defaultRoll)
            }); //300 ms
            
           

        }
    }
    
}

</script>
