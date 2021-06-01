new Vue({
    el: '#app',
    data:{
        title:'',
        posts: [
            // {
            //     title:'prova',
            //     content:'provaprova'
            // },
            // {
            //     title:'prova',
            //     content:'provaprova'
            //     },
            //     {
            //         title:'prova',
            //         content:'provaprova'
            //     }
        ]
    },
    methods:{
      postsSearch: function() {
        let link = 'http://localhost:8000/api/search'
        axios.get(link,{
            params: {
              title:this.title
            }
          }).then((result)=>{
            this.posts = result.data.hits;
            console.log(result.data.hits);
          });
        }
      },
    })
  