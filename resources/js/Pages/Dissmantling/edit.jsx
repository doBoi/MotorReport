import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, router } from '@inertiajs/react';
import { useState } from 'react';
import moment from 'moment';
import HandleUpdate from '@/Components/HandleUpdate';


export default function create(datas) {
  const [motors, setMotors] = useState(datas.datas)
  const [motor, setMotor] = useState(datas.data)
  // console.log(motor);

  const [values, setValues] = useState({
    sernum: motor.sernum,
    motor_id: parseInt(motor.motor_id),
    tgl: moment(motor.tgl).format('YYYY-MM-DD'),
    spk: motor.spk,
    keterangan: motor.keterangan,
    token: datas[0].csrf_token

  })



  function handleChange(e) {
    const key = e.target.id;
    const value = e.target.value
    setValues(values => ({
      ...values,
      [key]: value,
    }))
  }

  function handleSubmit(e) {
    e.preventDefault()
    router.put('/dissmantling/update', {
      sernum: values.sernum,
      motor_id: parseInt(values.motor_id),
      tgl: values.tgl,
      spk: values.spk,
      keterangan: values.keterangan,
      _token: datas[0].csrf_token
    }
    )
  }
  return (
    <>
      <AuthenticatedLayout
        user={datas.auth.user['name']}
        header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">{datas.title}</h2>}
      >
        <Head title={datas.title} />
        <div className="py-12 bg-transparent">
          <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div className="overflow-x-auto">
              <form className='w-full text-black' method='post' onSubmit={(e) => HandleUpdate(e, values, datas.to)}>

                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Serial Number</span>
                  </div>
                  <input id="sernum" value={values.sernum} onChange={handleChange} type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs text-white" />
                </label>

                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Horse Power (HP)</span>
                  </div>
                  <select className="select w-full max-w-xs text-white" id="motor_id" value={values.motor_id} onChange={handleChange}>
                    <option disabled selected>Pilih HP</option>
                    {
                      motors.map((item, i) => (
                        <option key={item.id} value={parseInt(item.id)}>
                          {i + 1}. {item.hp} HP, {item.volt} Volt, {item.amp} Amp
                        </option>
                      ))
                    }
                  </select>
                </label>


                <label className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Tanggal</span>
                  </div>
                  <input className='rounded-md bg-gray-900 text-white' type="date" name='tgl' id="tgl" value={values.tgl} onChange={handleChange} />

                </label>

                <label disabled className="form-control w-full max-w-xs m-2">
                  <div className="label">
                    <span className="label-text">Spk</span>
                  </div>
                  <input disabled name="spk" id="spk" value={values.spk} type="text" placeholder="Type here" className="input input-bordered w-full max-w-xs text-white" />
                </label>

                <label className="form-control m-2">
                  <div className="label">
                    <span className="label-text">Keterangan</span>
                  </div>
                  <textarea name="keterangan" id="keterangan" value={values.keterangan} onChange={handleChange} className=" text-white textarea textarea-bordered h-24" placeholder="Bio"></textarea>
                </label>


                <button type='submit' className="btn btn-neutral m-2">Neutral</button>
              </form>
            </div>
          </div>
        </div >
      </AuthenticatedLayout >

    </>
  );

}
