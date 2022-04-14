
<template>

    <div class="container">
        <div class="row">
            <div class="offset-md-3 col-md-6"></div>
            <h2>Nueva tirada</h2>
        
            <form-component @add="newRoll"></form-component>
        </div>    
      
        <div class="album py-5 bg-light">
            <div class="container">
    
                <div class="row">
                    <div class="offset-md-3"><h2>Tiradas</h2>
                    </div>
                    <card-component v-for="(roll,index) in rolls"
                        :roll="roll"
                        @delete="deleteRoll(index)"
                        :key="roll.id">


                    </card-component>    
                </div>
            </div>
        </div>
    </div>
    
    
    
    
</template>

<script>
import CardComponent from './CardComponent'
import FormComponent from './FormComponent'
export default {
    components: {
        CardComponent,
        FormComponent
    },

    data() {
        return {
             rolls: [
                //  {
                //      'index':1,
                //      'user_id' : '1',
                //      'value1':'1',
                //      'value2':'1'

                //  },
                //   {
                //      'index':2,
                //      'user_id' : '2',
                //      'value1':'2',
                //      'value2':'2'

                //  }
              
             ]
        }
    },
    methods: {
        newRoll(roll){
            this.rolls.push(roll);
            //console.log(roll,'xxxx')

        },
        deleteRoll(index){
            this.rolls.splice(index,1);

        }
       

    },
    mounted() {
            //console.log('ALELUYA-------');
             axios.get('api/rolls').then((response) => {
                  //console.log(response,'+++++++');
                  this.rolls = response.data.rolls
              });
         }


        
    
}
</script>
