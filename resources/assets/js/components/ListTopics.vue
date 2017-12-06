<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="list-group" v-for="topic in topics">
                        <a href="/topic/" class="list-group-item">
                            <h4 class="list-group-item-heading">{{ topic.title }}</h4>
                            <p class="list-group-item-text">{{ topic.description }}</p>
                        </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data:()=>{
            return {
                topics:[]
            }
        }
        ,created(){
            axios.get('/topics')
            .then((response)=>{
                this.topics = response.data;
            })
        }
    }
</script>
