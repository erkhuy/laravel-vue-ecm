<template>
  <div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12">
      <div class="login-box">
        <div class="login-logo">
          <a href>
            <b>Login</b>
          </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
          <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to manage</p>

            <form @submit.prevent="AdmLogin()">
              <div class="input-group mb-3">
                <input type="email" class="form-control" placeholder="Email" v-model="user.email" />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input
                  type="password"
                  class="form-control"
                  placeholder="Password"
                  v-model="user.password"
                />
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="remember" v-model="user.remember" />
                    <label for="remember">Remember Me</label>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Sign In
                    <i class="fa fa-sign-in-alt"></i>
                  </button>
                </div>
                <!-- /.col -->
              </div>
            </form>

            <div class="social-auth-links text-center mb-3">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
              </a>
            </div>-->
            <!-- /.social-auth-links -->

            <!-- <p class="mb-1">
              <a href="#">I forgot my password</a>
            </p>
            <p class="mb-0">
              <a href="register.html" class="text-center">Register a new membership</a>
            </p>-->
          </div>
          <!-- /.login-card-body -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user: new Form({
        email: null,
        password: null,
        remember: null
      })
    };
  },
  methods: {
    AdmLogin() {
      this.$store.dispath("retrieveToken", {
        email: this.user.email,
        password: this.user.password,
        remember: this.user.remember
      });
    }
  }
};
</script>
<style lang="scss" scoped >
</style>
