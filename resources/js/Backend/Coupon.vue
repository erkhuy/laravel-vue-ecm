<template>
  <div class="row">
    <div class="col-md-12">
      <div class="d-flex">
        <h3>Danh sách các mã giảm giá</h3>
        <button @click="newCoupon" class="btn btn-outline-primary ml-3">
          <i class="fa fa-plus"></i>Thêm mới mã giảm giá
        </button>
      </div>
      <div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Code</th>
              <th>Ngày hết hạn</th>
              <th>Loại</th>
              <th>Giá trị</th>
              <th>Số lượng</th>
              <th>Trạng thái</th>
              <th>Tùy chọn</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(cp , index) in coupons.data" :key="index">
              <td>{{ cp.id }}</td>
              <td>{{ cp.code|uppercase }}</td>
              <td>{{ cp.expiry_date }}</td>
              <td>
                <p v-if="cp.type=='Monney'">Tiền mặt</p>
                <p v-if="cp.type=='Percent'">Phần trăm</p>
                <p v-if="cp.type=='Freeship'">Miễn ship</p>
              </td>

              <td>
                <p
                  v-if="cp.type=='Monney'"
                >{{ cp.discount | currency('VND', 0, { symbolOnLeft: false }) }}</p>
                <p v-if="cp.type=='Percent'">{{ cp.discount }} %</p>
                <p
                  v-if="cp.type=='Freeship'"
                >{{ 30000 | currency('VND', 0, { symbolOnLeft: false }) }}</p>
              </td>
              <td>{{ cp.amount }}</td>
              <td>
                <p v-if="cp.status=='0'">Không khả dụng</p>
                <p v-else>Khả dụng</p>
              </td>
              <td>
                <a class="btn btn-outline-primary" title="cập nhật" @click="editcoupon(cp)">
                  <i class="fa fa-edit"></i>
                </a>
                <a class="btn btn-outline-dark" title="xóa" @click="deleteCoupon(cp.id)">
                  <i class="fa fa-recycle text-danger"></i>
                </a>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination :data="coupons" @pagination-change-page="getCoupon"></pagination>
      </div>
    </div>
    <div
      class="modal fade"
      id="CouponModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="CouponModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="CouponModalLabel"
            >{{ (actionCoupon=='create')?'Thêm mới Mã giảm giá':'Cập nhật mã giảm giá' }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="(actionCoupon=='create')?addCoupon():updateCoupon()">
            <div class="modal-body">
              <div class="form-group d-flex">
                <div>
                  <label for>Code</label>
                  <input
                    type="text"
                    name="code"
                    class="form-control text-uppercase"
                    :class="{ 'is-invalid': coupon.errors.has('code') }"
                    v-model="coupon.code"
                  />
                  <has-error :form="coupon" field="code"></has-error>
                </div>
                <div>
                  <label for>Ngày hết hạn</label>
                  <input
                    type="date"
                    name="expiry_date"
                    class="form-control"
                    :class="{ 'is-invalid': coupon.errors.has('expiry_date') }"
                    v-model="coupon.expiry_date"
                  />
                  <has-error :form="coupon" field="expiry_date"></has-error>
                </div>
              </div>
              <div class="form-group d-flex">
                <div class="mr-3">
                  <label for>Số lượng</label>
                  <input
                    type="text"
                    name="amount"
                    class="form-control"
                    :class="{ 'is-invalid': coupon.errors.has('amount') }"
                    v-model="coupon.amount"
                  />
                  <has-error :form="coupon" field="amount"></has-error>
                </div>
                <div>
                  <label for>Giá trị</label>

                  <div v-if="coupon.type=='Percent'">
                    <input
                      type="range"
                      class="custom-range"
                      name="discount"
                      :class="{ 'is-invalid': coupon.errors.has('discount') }"
                      v-model="coupon.discount"
                    />
                    <p class="text-primary">{{ coupon.discount }} %</p>
                  </div>
                  <div
                    v-if="coupon.type=='Freeship'"
                  >{{ couponDiscount | currency('VND', 0, { symbolOnLeft: false }) }}</div>
                  <div v-if="coupon.type=='Monney'">
                    <input
                      type="text"
                      name="discount"
                      class="form-control"
                      :class="{ 'is-invalid': coupon.errors.has('discount') }"
                      v-model="coupon.discount"
                    />
                  </div>
                  <has-error :form="coupon" field="discount"></has-error>
                </div>
              </div>
              <div class="form-group d-flex">
                <div>
                  <label for>Loại mã giảm giá</label>
                  <select v-model="coupon.type" class="form-control">
                    <option disabled value>Chọn loại mã giảm giá</option>
                    <option value="Monney">Tiền mặt</option>
                    <option value="Percent">Phần trăm</option>
                    <option value="Freeship">Miễn ship</option>
                  </select>
                  <has-error :form="coupon" field="type"></has-error>
                </div>
                <div>
                  <label for>Trạng thái</label>
                  <br />
                  <input type="radio" id="one" value="1" v-model="coupon.status" />
                  <label for="one">Khả dụng</label>
                  <br />
                  <input type="radio" id="two" value="0" v-model="coupon.status" />
                  <label for="two">Không khả dụng</label>
                  <br />
                  <has-error :form="coupon" field="status"></has-error>
                </div>
              </div>
            </div>
            <button type="button" class="btn btn-secondary m-3" data-dismiss="modal">Hủy</button>
            <button
              type="submit"
              class="btn btn-primary m-3"
            >{{ (actionCoupon=='create')?'Thêm mới':'Cập nhật' }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      coupons: {},
      coupon: new Form({
        id: "",
        code: null,
        expiry_date: null,
        amount: null,
        status: "0",
        type: "Monney",
        discount: 0
      }),
      actionCoupon: "create",
      actionType: "money"
    };
  },
  methods: {
    newCoupon() {
      $("#CouponModal").modal("show");
      this.actionCoupon = "create";
      this.coupon.reset();
    },
    getCoupon(page = 1) {
      axios.get("/api/admin/coupon?page=" + page).then(response => {
        this.coupons = response.data;
      });
    },
    addCoupon() {
      this.coupon
        .post("/api/admin/coupon")
        .then(({ data }) => {
          if (data.status == true) {
            $("#CouponModal").modal("hide");
            this.$emit("AfterCreateCoupon");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Thêm mới  thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!<br>" + data
            });
          }
        })
        .catch(error => {});
    },
    loadCoupon() {
      axios.get("/api/admin/coupon").then(({ data }) => {
        this.coupons = data;
      });
    },
    updateCoupon() {
      this.coupon
        .put("/api/admin/coupon/" + this.coupon.id)
        .then(({ data }) => {
          if (data.status == true) {
            $("#CouponModal").modal("hide");
            this.$emit("AfterCreateCoupon");
            Swal.fire({
              position: "top-end",
              type: "success",
              title: "Cập nhật  thành công",
              showConfirmButton: false,
              timer: 1000
            });
          } else {
            Swal.fire({
              type: "error",
              title: "Oops...",
              text: "Có lỗi xảy ra!<br>" + data
            });
          }
        })
        .catch(err => {});
    },
    editcoupon(coupon) {
      $("#CouponModal").modal("show");
      this.actionCoupon = "edit";
      this.coupon.fill(coupon);
    },
    deleteCoupon(id) {
      Swal.fire({
        title: "Bạn có chắc chắn?",
        text: "Xác nhận xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa  !",
        cancelButtonText: "Hủy!"
      }).then(result => {
        if (result.value) {
          this.coupon
            .delete("/api/admin/coupon/" + id)
            .then(() => {
              this.$emit("AfterCreateCoupon");
              Swal.fire({
                position: "top-end",
                type: "success",
                title: "Xóa  thành công",
                showConfirmButton: false,
                timer: 1000
              });
            })
            .catch(() => {
              Swal.fire({
                type: "error",
                title: "Oops...",
                text: "Có lỗi xảy ra!",
                footer: "<a href>Thử lại sau ?</a>"
              });
            });
        }
      });
    }
  },
  computed: {
    couponDiscount() {
      return (this.coupon.discount = 30000);
    }
  },
  created() {
    this.loadCoupon();
    this.loadCoupon();
    this.$on("AfterCreateCoupon", () => {
      this.loadCoupon();
    });
  }
};
</script>
