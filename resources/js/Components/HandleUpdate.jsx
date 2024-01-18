import { router } from '@inertiajs/react';
import { toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';


export default function HandleUpdate(e, values, to) {
  e.preventDefault()
  router.put('/' + to + '/update', {
    sernum: values.sernum,
    motor_id: parseInt(values.motor_id),
    tgl: values.tgl,
    spk: values.spk,
    keterangan: values.keterangan,
    _token: values.token
  }
  )
  toast.warning(values.spk + " berhasil Diubah",
    {
      position: "top-center",
      autoClose: 1000,
      hideProgressBar: false,
      closeOnClick: true,
      pauseOnHover: true,
      draggable: true,
      theme: "colored",
    }
  );
}
