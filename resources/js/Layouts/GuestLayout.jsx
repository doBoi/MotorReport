import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link, Head } from '@inertiajs/react';
import logo from '../img/DB.svg'

export default function Guest({ children }) {
    return (
        <>
            <Head>
                <link rel="icon" type="image/svg+xml" href={logo} />
            </Head>

            <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div>
                    <Link href="/">
                        <img src={logo} className='w-36 h-36 fill-current text-gray-500' alt="" />
                    </Link>
                </div>

                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    {children}
                </div>
            </div>
        </>
    );
}
