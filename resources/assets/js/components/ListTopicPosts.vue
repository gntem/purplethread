<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-1">
                <nav aria-label="Page navigation">
                <ul class="pagination">
                    <li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                    </li>
                    <li v-for="page in pagination.last_page" :key="page">
                        <a v-bind:href="'/topic/'+topicId+'/posts?page='+page">{{page}}</a>
                    </li>
                    <li>
                    <a href="#" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                    </li>
                </ul>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="list-group" v-for="post in posts" :key="post.id">
                        <a v-bind:href="'/topic/'+post.topic+'/post/'+post.id+'/comments'" class="list-group-item">
                            <h4 class="list-group-item-heading">Post #{{ post.id }}</h4>
                            <p class="list-group-item-text">{{ post.body }}</p>
                        </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:[
            'topicId'
        ]
        ,data:()=>{
            return {
                pagination:{}
                ,posts:[]
            }
        }
        ,created(){
            axios
            .get('/topic/'+this.topicId+'/posts')
            .then((response)=>{
                this.pagination = _.omit(response.data,'data');
                this.posts = response.data.data;
            })
        }
    }
</script>
