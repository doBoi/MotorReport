export default function ButtonEdit({ to, items }) {
  return (
    <a href={route(to, items)}>
      <button className="btn btn-warning m-2">Edit</button>
    </a>
  )
}
