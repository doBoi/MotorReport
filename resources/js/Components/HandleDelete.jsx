import { router } from '@inertiajs/react';
import { toast } from 'react-toastify';

export default function handleDelete(e, to, slug, token) {
  router.delete("/" + to + "/" + slug, {
    _token: token
  }
  )
  toast.error('Data berhasil Dihapus 🗑',
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
  // setItems((items) => items.filter((item) => item.slug !== e.target.value))
}
