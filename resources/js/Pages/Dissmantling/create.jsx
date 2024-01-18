import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import moment from 'moment';
import HandleStore from '@/Components/HandleStore'



export default function create(datas) {
  const [values, setValues] = useState({
    sernum: "",
    motor_id: 1,
    tgl: moment(new Date()).format('YYYY-MM-DD'),
    spk: '1111/M/' + moment(new Date()).format('MM') + '/' + moment(new Date()).format('YYYY'),
    keterangan: '',
    token: datas[0].csrf_token
  })
  const [motors, setMotors] = useState(datas)


  function handleChange(e) {
    const key = e.target.id;
    const value = e.target.value
    setValues(values => ({
      ...values,
      [key]: value,
    }))
  }


  return (
    <>
      <AuthenticatedLayout
        user={motors.auth.user}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{motors.title}</h2>}
      >
        <Head title={datas.title} />
        <div className="py-12 bg-transparent">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div className="overflow-x-auto">
              <form className='w-full text-black' method='post' onSubmit={(e) => HandleStore(e, values, datas.to)}>

                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Serial Number</span>
                  </div>
                  <input name="sernum" id="sernum" value={values.sernum} onChange={handleChange} type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs text-white" />
                </label>

                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Horse Power (HP)</span>
                  </div>
                  <select name='motor_id' className="select w-full max-w-xs text-white" id="motor_id" value={values.id} onChange={handleChange}>
                    <option hidden disabled selected>Pilih HP</option>
                    {motors.data.map((item, i) => (
                      <option className='pb-2' key={item.id} value={parseInt(item.id)}>
                        {i + 1}. {item.hp} HP, {item.volt} Volt, {item.amp} Amp
                      </option>
                    ))}
                  </select>
                </label>


                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Tanggal</span>
                  </div>
                  <input className='rounded-md bg-gray-900 text-white' type="date" name='tgl' id="tgl" value={values.tgl} onChange={handleChange} />

                </label>

                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Spk</span>
                  </div>
                  <input name="spk" id="spk" value={values.spk} onChange={handleChange} type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs text-white" />
                </label>

                <label className="form-control m-2">
                  <div className="label">
                    <span className="label-text">Keterangan</span>
                  </div>
                  <textarea name="keterangan" id="keterangan" value={values.keterangan} onChange={handleChange} className=" text-white textarea textarea-bordered h-24" placeholder="Bio"></textarea>
                </label>

                <button type='submit' className="btn btn-neutral m-2">Simpan</button>
              </form>
            </div>
          </div>
        </div >
      </AuthenticatedLayout >

    </>
  );

}
