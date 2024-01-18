import { router } from '@inertiajs/react';
import { toast } from 'react-toastify';


export default function HandleStore(e, values, to) {
  e.preventDefault();
  router.post('/' + to + '/store', {
    sernum: values.sernum,
    motor_id: parseInt(values.motor_id),
    tgl: values.tgl,
    spk: values.spk,
    keterangan: values.keterangan,
    _token: values.token
  }
  )
  toast.success(values.sernum + " berhasil Ditambahkan 🔥", {
    position: "top-center",
    autoClose: 1000,
    hideProgressBar: true,
    closeOnClick: true,
    pauseOnHover: true,
    draggable: true,
    progress: undefined,
    theme: "colored",
  });
}
