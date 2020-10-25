const {useEffect,useState,useRef} = React;

function Comment(props) {
    const {image,user_id,post_id} = props.data;
    const [comment,setComment] = useState('');
    const [commentList,setCommentList] = useState([]);
    const [queryString,setQueryString] = useState({
        post_id: post_id,
        latest: true,
        limit:10,
    });
    const commentRef = useRef();

    useEffect(() => {
        const getCommentList = async () => {
            const {post_id,latest,limit} = queryString;
            fetch(`/?site=get_comment&post_id=${post_id}&latest=${latest}&limit=${limit}`).then((response) => {
                response.text().then((text) => {
                    const data = text.split('@JSON@')[1];
                    setCommentList(JSON.parse(data));
                })
            }).catch((error) => {
                console.log(error);
            });
        }
        getCommentList();
    },[comment == '',queryString]);

    const handleCommentInput = async (event) => {
        const {value} = event.target;
        setComment(value);
    }

    const handleAddComment = async () => {
        if (!comment) {
            alert('Say something...');
        } else {
            const data = new FormData();
            data.append('user_id',user_id);
            data.append('post_id',post_id);
            data.append('comment',comment);
    
            
            fetch('/?site=add_comment', {
                method: "POST",
                body: data,
            }).then((result) => {
                if (result.status == 200) {
                    commentRef.current.value = '';
                    setComment('');
                }
            })
            .catch((error) => {
              console.error('Error:', error);
            });
        }
    }

    const handleSorting = async (event) => {
        const value = await JSON.parse(event.target.value);
        await setQueryString({
            ...queryString,
            latest:value,
        });

    }

    const handleGetMoreComments = async (event) => {
        event.preventDefault();
        await setQueryString({
            ...queryString,
            limit: queryString.limit + 10,
        });
    }
    
    console.log(queryString);
    return (
        <React.Fragment>
            {user_id && <CommentForm 
                commentInput={handleCommentInput}
                addComment={handleAddComment}
                commentValue={comment}
                commentRef={commentRef}
                userImage={image}
                commentSortingType={queryString.latest}
                changeCommentSortingType={handleSorting}
            />}
            <br></br>
            <CommentList data={commentList} getMoreComments={handleGetMoreComments}/>
        </React.Fragment>
    );
}

function CommentForm(props) {
    const {commentInput,addComment,commentValue,commentRef,userImage,commentSortingType,changeCommentSortingType} = props;
    return (
        <article className="media">
            <figure className="media-left">
                <p className="image is-64x64 is-square">
                    <img className="is-rounded" src={`src/Storage/Images/${userImage}`}/>
                </p>
            </figure>
            <div className="media-content">
                <div className="field">
                <p className="control">
                    <textarea className="textarea" placeholder="Add a comment..." onChange={commentInput} ref={commentRef}></textarea>
                </p>
                </div>
                <nav className="level">
                <div className="level-left">
                    <div className="level-item">
                    <a className="button is-info" onClick={addComment}>Add</a>
                    </div>
                </div>
                <div className="level-right">
                    <div className="level-item">
                    <label className="checkbox">
                        {commentValue.length}/1000
                    </label>
                    <div className="control ml-4">
                        <div className="select">
                            <select value={commentSortingType} onChange={changeCommentSortingType}>    
                                <option value={true}>Latest</option>
                                <option value={false}>Oldest</option>
                            </select>
                        </div>
                    </div>
                    </div>
                </div>
                </nav>
            </div>
        </article>
    );
}

function CommentList(props) {
    const {data,getMoreComments} = props;
    return (
        <React.Fragment>
            {data.map((comment,index) => {
                return <div className="bd-snippet-preview mb-4" key={index}>
                <article className="media">
                    <figure className="media-left">
                    <p className="image is-64x64 is-square">
                        <img className="is-rounded" src={`src/Storage/Images/${comment.avatar}`}/>
                    </p>
                    </figure>
                    <div className="content">
                        <p>
                            <a style={{color:'black'}} href={`/?site=user_profile&id=${comment.user_id}`}><strong>{comment.username}</strong></a>
                        <br/>
                            <span style={{fontStyle:'italic',fontSize:'0.9em'}}>
                                {comment.comment}
                            </span>
                        <br/>
                            <small><a>Like</a> · {comment.created_at}</small>
                        </p>
                    </div>
                </article>
            </div>
            })}
            <a href=" #" onClick={getMoreComments}>More comments</a>
        </React.Fragment>
    );
}