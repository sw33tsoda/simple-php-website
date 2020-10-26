const {useEffect,useState,useRef} = React;

function CommentSection(props) {
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
            {data.map((comment,index) => <Comment key={index} data={comment}/>)}
            <a href=" #" onClick={getMoreComments}>More comments</a>
        </React.Fragment>
    );
}

function Comment(props) {
    const {avatar,user_id,username,comment,created_at,upvotes,downvotes,id} = props.data;

    const handleVoting = async (vote) => {
        fetch(`/?site=vote&comment_id=${id}&user_id=${user_id}&vote_type=${vote}`).then(response => {
            console.log(response);
        }).catch(error => {
            console.log(error);
        });
    }

    return (
        <div className="bd-snippet-preview mb-4">
            <article className="media">
                <figure className="media-left">
                <p className="image is-64x64 is-square">
                    <img className="is-rounded" src={`src/Storage/Images/${avatar}`}/>
                </p>
                </figure>
                <div className="content">
                    <p>
                        <a style={{color:'black'}} href={`/?site=user_profile&id=${user_id}`}><strong>{username}</strong></a>
                    <br/>
                        <span style={{fontStyle:'italic',fontSize:'0.9em'}}>
                            {comment}
                        </span>
                    <br/>
            
                    </p>

                    <div className="field is-grouped is-grouped-multiline mt-4">
                        <div className="control">
                            <div className="tags has-addons" onClick={() => handleVoting('upvote')}>
                                <span className="tag">Upvote</span>
                                <p className="tag is-success">{upvotes}</p> 
                            </div>
                        </div>
                        <div className="control">
                            <div className="tags has-addons" onClick={() => handleVoting('downvote')}>
                                <span className="tag">Downvote</span>
                                <p className="tag is-danger">{downvotes}</p> 
                            </div>
                        </div>
                        <small>{created_at}</small>
                    </div>
                </div>
            </article>
        </div>        
    );
}