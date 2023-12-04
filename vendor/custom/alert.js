function loading_sw2() {
  Swal.fire({
    title: "Mohon Ditunggu",
    html: '<div class="loader mb-5 mt-5 text-center"></div>',
    allowOutsideClick: false,
    showConfirmButton: false,
    backdrop: true,
  });
}

function custom_alert(klickoutside, icon, title, timer) {
  Swal.fire({
    allowOutsideClick: klickoutside,
    backdrop: true,
    icon: icon,
    title: title,
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}
function custom_alert_link(klickoutside, icon, title, timer, link) {
  Swal.fire({
    allowOutsideClick: klickoutside,
    backdrop: true,
    icon: icon,
    title: title,
    showConfirmButton: false,
    timer: timer,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  }).then(function () {
    document.location.href = link;
  });
}

function simpan_tidaksesuai() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "warning",
    title: "DATA ADA YANG TIDAK SESUAI",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function simpan_berhasil(link) {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "success",
    title: "DATA BERHASIL DISIMPAN",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  }).then(function () {
    document.location.href = link;
  });
}

function simpan_gagal_database() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "error",
    title: "DATA GAGAL DISIMPAN KE DATABASE",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function ubah_berhasil() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "success",
    title: "DATA BERHASIL DIUBAH",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function ubah_gagal_database() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "error",
    title: "DATA GAGAL DISIMPAN KE DATABASE",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function hapus_berhasil(link) {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "success",
    title: "DATA BERHASIL DIHAPUS!",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  }).then(function () {
    document.location.href = link;
  });
}

function hapus_gagal() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "error",
    title: "DATA GAGAL DIHAPUS!",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function error() {
  Swal.fire({
    allowOutsideClick: true,
    backdrop: true,
    icon: "error",
    html: "<div class='b'>Data Error!</div>",
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });
}

function idle_logout() {
  Swal.fire({
    allowOutsideClick: false,
    backdrop: true,
    icon: "warning",
    html: "Anda <b>IDLE/AFK</b> selama 4 Jam, akan <b>LOGOUT</b> secara Otomatis",
    showConfirmButton: true,
    timer: 60000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  }).then(function () {
    document.location.href = "?lo";
  });
}
