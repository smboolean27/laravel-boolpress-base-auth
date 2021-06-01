new Vue({
    el: '#app',
    data:{
        title:'',
        posts: []
    },
    methods:{
      postsSearch: function() {
        let link = 'http://localhost:8000/api/search'
        axios.get(link,{
            params: {
              title:this.title
            }
          }).then((result)=>{
            this.posts = result.data;
          });
        }
      },
    })
  