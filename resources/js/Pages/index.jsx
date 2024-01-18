import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head } from '@inertiajs/react';
import { useState, useEffect } from 'react';
import moment from 'moment';
import ButtonCreate from '@/Components/ButtonCreate';
import ButtonEdit from '@/Components/ButtonEdit'
import handleDelete from '@/Components/HandleDelete';
import { ToastContainer } from "react-toastify";



export default function index(datas) {
  const [items, setItems] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const result = await datas;
        setItems(result.data);
      } catch (error) {
        console.error('Error Get data:', error);
      }
    };

    fetchData();
  }, [items]);


  return (
    <>
      <AuthenticatedLayout
        user={datas.auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{datas.title}</h2>}
      >
        <Head title="Assemblings" />
        <div className="py-12 bg-transparent">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div className="overflow-x-auto">
              <ButtonCreate links={datas.to} ></ButtonCreate>
              <table className="lg:table table-xs ">
                <thead>
                  <tr className='text-black text-xl'>
                    <th>Serial Number</th>
                    <th>Hp</th>
                    <th>Voltage</th>
                    <th>Ampere</th>
                    <th className='text-center'>Spk</th>
                    <th className='text-center'>Tanggal</th>
                    <th className='text-center'>Action</th>
                  </tr>
                </thead>

                <tbody>
                  {items.map((item, i) => (
                    <tr key={i} className="hover text-black hover:text-white">
                      <td className='text-lg'>{item.sernum}</td>
                      <td className='text-lg'>{item.motor.hp}</td>
                      <td className='text-lg'>{item.motor.volt}</td>
                      <td className='text-lg'>{item.motor.amp}</td>
                      <td className='text-lg'>{item.spk}</td>
                      <td className='text-center text-lg'>
                        {moment(item.tgl).format('DD MMM, YYYY')}
                      </td>
                      <td className='text-center'>
                        <ButtonEdit items={item.slug} to={datas.edit}></ButtonEdit>
                        <button onClick={(e) => handleDelete(e, datas.to, item.slug, datas[0].csrf_token)} className="btn btn-error">
                          Hapus
                        </button>
                      </td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          </div>
        </div >
      </AuthenticatedLayout >
    </>
  );
}
