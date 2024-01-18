export default function ButtonCreate({ links }) {
  return (
    <a href={route(links + ".create")}>
      <button className="btn btn-outline btn-warning sm:btn-sm md:btn-md lg:btn-lg">Create</button>
    </a >
  )
}
