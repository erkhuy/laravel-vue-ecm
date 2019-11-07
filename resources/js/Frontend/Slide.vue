<template>
  <div class="container">
    <aside class="slide">
      <div class="row">
        <div class="col-lg-12 col-md-12-col-sm-12">
          <carousel
            :per-page="1"
            :autoplay="true"
            :autoplayTimeout="2000"
            :loop="true"
            paginationPosition="bottom-overlay"
          >
            <slide v-for="(slide , index) in slides" :key="index">
              <div class="slide__item">
                <div class="slide__item__img">
                  <a>
                    <img :src="'/images/slides/'+slide.image" />
                  </a>
                </div>
                <div class="slide__item__des">
                  <p>{{ slide.description }}</p>
                </div>
              </div>
            </slide>
          </carousel>
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
<style lang="scss" scoped>
.slide {
  &__item {
    &__img {
      a > img {
        width: 100%;
        max-height: 600px;
        height: 100%;
      }
    }
    position: relative;
    &__des {
      position: absolute;
      z-index: 6;
      left: 40%;
      bottom: 10%;
      font-size: 2em;
    }
  }
}
</style>
