<template>
  <div class="container">
    <aside class="slide">
      <div class="row">
        <div class="col-lg-12 col-md-12-col-sm-12">
          <div class="slide__wrap">
            <div class="slide__item" v-for="(slide , index) in slides" :key="index">
              <div class="slide__item__img">
                <a>
                  <img :src="'/images/slide/'+slide.img" />
                </a>
              </div>
              <div class="slide__item__des">
                <p>{{ slide.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </aside>
  </div>
</template>
<script>
export default {
  data() {
    return {
      slides: {}
    };
  },
  methods: {
    getSlides() {
      axios
        .get("/api/admin/getSlides")
        .then(res => {
          this.slides = res.data;
        })
        .catch(err => {
          console.error(err);
        });
    }
  },
  created() {
    this.getSlides();
  }
};
</script>
